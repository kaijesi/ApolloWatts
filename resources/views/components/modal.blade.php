{{-- 
Modal Component

Component for a generic modal that can be customised and into which other content can be inserted.
--}}

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalTitle }}" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $modalTitle }}">{{ $modalTitle }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            @if ($modalAction)
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">{{ $modalAction }}</button>
                </div>
            @else
                
            @endif
        </div>
    </div>
</div>