<div class="space-y-8">
    @foreach ($projects as $project)
        {{-- Вызываем ProjectCard из папки Stock --}}
        <livewire:stock.project-card 
            :project="$project" 
            wire:key="project-{{ $project['id'] }}" 
        />
    @endforeach
</div>