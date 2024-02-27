<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Job;
use Livewire\WithFileUploads;

class JobComponent extends Component
{
    use WithFileUploads;

    public $jobs;
    public $name;
    public $description;
    public $image;
    public $cost;
    public $job_id;
    public $jobModal = false;
    public $confirmDeleteJobModal = false;

    public function mount()
    {
        $this->jobs = Job::all();
    }

    public function rules()
    {
        return [
            'name' => 'required|max:30',
            'description' => 'required|max:100',
            'image' => 'required',
            'cost' => 'required',
        ];
    }

    public function openEditModal($id)
    {
        $job = Job::find($id);
        $this->job_id = $job->id;
        $this->name = $job->name;
        $this->description = $job->description;
        $this->image = $job->image;
        $this->cost = $job->cost;
        $this->jobModal = true;
    }

    public function confirmDeleteJob($id)
    {
        $this->job_id = $id;
        $this->confirmDeleteJobModal = true;
    }

    public function deleteJob($id)
    {
        Job::destroy($id);
        $this->jobs = Job::all();
        $this->confirmDeleteJobModal = false;
    }

    public function closeModal()
    {
        $this->jobModal = false;
        $this->reset(['name', 'description', 'image', 'cost', 'job_id']);
        $this->confirmDeleteJobModal = false;
    }

    public function addJob()
    {
        $validatedData = $this->validate([
            'name' => 'required|max:30',
            'description' => 'required|max:100',
            'image' => 'required|image|max:1024',
            'cost' => 'required',
        ]);

        $imagePath = $this->image->store('public/images');
        $imageName = basename($imagePath);

        Job::create([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $imageName,
            'cost' => $this->cost,
        ]);

        $this->reset(['name', 'description', 'image', 'cost']);
        $this->jobs = Job::all();
        $this->jobModal = false;
    }

    public function updateJob()
    {
        $job = Job::find($this->job_id);
        $job->update([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'cost' => $this->cost,
        ]);

        $this->reset(['name', 'description', 'image', 'cost', 'job_id']);
        $this->jobs = Job::all();
        $this->jobModal = false;
    }

    public function render()
    {
        return view('livewire.job-component');
    }
}
