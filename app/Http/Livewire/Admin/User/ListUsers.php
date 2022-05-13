<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;

use function PHPUnit\Framework\isNull;

class ListUsers extends AdminComponent
{

    use WithFileUploads;

    public $state = [];

    public $showEditModal = false;

    public $user;

    public $userIdBegingRemoved;

    public $searchTerm = null;

    public $photo;
    
    public function resetCurrentPage()
    {
        $this->resetPage();
    }

    public function addNew()
    {
        $this->reset(['state','showEditModal','user','userIdBegingRemoved','searchTerm','photo']);
        $this->showEditModal = false;
        // $this->state = [];        
        $this->dispatchBrowserEvent('show-form');
    }

    public function createUser()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            // 'password_confirmation'=>'required'
        ])->validate();

        // encrypt password
        $validatedData['password'] = bcrypt($validatedData['password']);

        if ($this->photo) {
            $imageUrl = $this->photo->store('/', 'avatars');
            // dd($imageUrl);
            $validatedData['avatar'] = $imageUrl;
        }

        User::create($validatedData);

        $this->state = [];

        session()->flash('message', 'User Created Succesfully!');

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User Created Succesfully!']);
    }

    public function edit(User $user)
    {
        // $this->reset();
        $this->reset(['state','showEditModal','user','userIdBegingRemoved','searchTerm','photo']);
        $this->showEditModal = true;
        $this->user = $user;
        $this->state = $user->toArray();
        // dd($this->state);
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->state['id'],
            'password' => 'sometimes|confirmed',
            'password_confirmation' => 'sometimes|same:password',
        ])->validate();

        // encrypt password
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        if ($this->photo) {
            // delete old photo befor update
            if (!isNull($this->user->avatar)) {
                Storage::disk('avatars')->delete($this->user->avatar);
            }


            $imageUrl = $this->photo->store('/', 'avatars');
            // dd($imageUrl);
            $validatedData['avatar'] = $imageUrl;
        }

        $this->user->update($validatedData);

        $this->user = null;

        // User::where('id',$this->state['id'])->update($validatedData);
        $this->state = [];

        session()->flash('message', 'User Updated Succesfully!');

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User Updated Succesfully!']);
    }

    public function confirmUserRemoval($userId)
    {
        $this->userIdBegingRemoved = $userId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser()
    {
        $user = User::findOrFail($this->userIdBegingRemoved);

        $user->delete();

        // User::where('id',$this->userIdBegingRemoved)->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'User ID: ' . $this->userIdBegingRemoved . ', has delete successfully!']);
    }
    

    public function render()
    {
        $users = User::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
            ->latest()->paginate($this->rowPerpage);
        // dd($this->page);
        return view('livewire.admin.user.list-users', ['users' => $users]);
    }

    // delete old upload file from yesterday
    protected function cleanupOldUploads()
    {
        $storage = Storage::disk('local');

        foreach ($storage->allFiles('livewire-tmp') as $filePathname) {
            // $storage->delete($filePathname);
            $yesterdayStam = now()->subDay()->timestamp;
            if ($yesterdayStam > $storage->lastModified($filePathname)) {
                $storage->delete($filePathname);
            }
        }
    }
}
