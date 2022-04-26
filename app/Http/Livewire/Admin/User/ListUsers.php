<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $state = [];
    public $showEditModal = false;
    public $user;
    public $userIdBegingRemoved;

    public function addNew()
    {
        $this->showEditModal = false;
        $this->state = [];
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

        User::create($validatedData);
        $this->state = [];
        session()->flash('message', 'User Created Succesfully!');
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User Created Succesfully!']);
    }

    public function edit(User $user)
    {
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
        $users = User::latest()->paginate(10);
        // dd($this->page);
        return view('livewire.admin.user.list-users', ['users' => $users]);
    }
}
