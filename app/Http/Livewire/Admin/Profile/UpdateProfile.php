<?php

namespace App\Http\Livewire\Admin\Profile;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;


class UpdateProfile extends Component
{
    use WithFileUploads;

    public $image;

    public function updatedImage() // updated hook for $image
    {
        $path = $this->image->store('/', 'avatars');

        if (!is_null(auth()->user()->avatar)) {
            Storage::disk('avatars')->delete(auth()->user()->avatar);
        }
        auth()->user()->update(['avatar' => $path]);

        $this->dispatchBrowserEvent('updated', ['message' => 'Profile changed successfully!']);
    }

    public function render()
    {
        return view('livewire.admin.profile.update-profile');
    }

    // delete old upload file from yesterday
    protected function cleanupOldUploads()
    {
        $storage = Storage::disk('local');

        foreach ($storage->allFiles('livewire-tmp') as $filePathname) {
            // $storage->delete($filePathname);
            $yesterdayStam = now()->subSecond(5)->timestamp;
            if ($yesterdayStam > $storage->lastModified($filePathname)) {
                $storage->delete($filePathname);
            }
        }
    }
}
