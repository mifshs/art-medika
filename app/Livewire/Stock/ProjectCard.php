<?php

namespace App\Livewire\Stock;

use Livewire\Component;

class ProjectCard extends Component
{
    public array $project;

    public function mount(array $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.stock.project-card');
    }
}