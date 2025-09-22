@extends('dashboard.layouts.master')

@section('css')

@endsection

@section('content')
    <div>
        @livewire('group-inventories.group-inventories',[isset($forceDetails) ? $forceDetails : null])
    </div>
@endsection

@section('js')

{{-- Script for Get Group-Inventory-Details --}}
<script>
function initExpandableSections() {
    // Remove any existing handlers to prevent duplicates
    $(document).off('click', '.section-header');
    
    // Use event delegation to handle dynamically added content
    $(document).on('click', '.section-header', function() {
        const target = $(this).data('target');
        const $content = $('#' + target);
        
        console.log('Section clicked:', target);
        
        $(this).toggleClass('expanded');
        $content.toggleClass('expanded');

        // Close other sections when opening one
        if ($(this).hasClass('expanded')) {
            $('.section-header').not(this).removeClass('expanded');
            $('.section-content').not($content).removeClass('expanded');
        }
    });
}

$(document).ready(function() {
    // Initialize on page load
    initExpandableSections();
});

// Re-initialize after Livewire updates
document.addEventListener('livewire:navigated', initExpandableSections);
document.addEventListener('livewire:load', initExpandableSections);

// For Livewire v3 (if you're using it)
if (typeof Livewire !== 'undefined') {
    Livewire.hook('morph.updated', () => {
        initExpandableSections();
    });
}
</script>
{{-- End-Script for Get Group-Inventory-Details --}}

@endsection