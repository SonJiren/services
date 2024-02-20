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
    public $job_id;
    public $confirmJobModal = false;
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

        ];
    }

    public function openEditModal($id)
    {
        $job = Job::find($id);
        $this->job_id = $job->id;
        $this->name = $job->name;
        $this->description = $job->description;
        $this->image = $job->image;
        $this->jobModal = true;
    }

    public function confirmDeleteJob($id)
    {
        $this->job_id = $id;
        $this->confirmJobModal = true;
        $this->confirmDeleteJobModal = true;
    }

    public function deleteJob($id)
    {
        Job::destroy($id);
        $this->confirmJobModal = false;
        $this->jobs = Job::all();
        $this->confirmDeleteJobModal = false;
    }

    public function closeModal()
    {
        $this->jobModal = false;
        $this->reset(['name', 'description', 'image', 'job_id']);
        $this->confirmDeleteJobModal = false;
    }

    /*   public function addJob()
    {
        Job::create([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
        ]);

        $this->reset(['name', 'description', 'image']);
        $this->jobs = Job::all();
        $this->jobModal = false;
    } */
    public function addJob()
    {
        $validatedData = $this->validate([
            'name' => 'required|max:30',
            'description' => 'required|max:100',
            'image' => 'required|image|max:1024',
        ]);

        $imagePath = $this->image->store('public/images');
        $imageName = basename($imagePath);

        Job::create([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $imageName,
        ]);

        $this->reset(['name', 'description', 'image']);
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
        ]);

        $this->reset(['name', 'description', 'image', 'job_id']);
        $this->jobs = Job::all();
        $this->jobModal = false;
    }

    public function render()
    {
        return view('livewire.job-component');
    }
}
