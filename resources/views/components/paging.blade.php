<div class="mt-4">
	@if(!empty($model))
		{{ $model->onEachSide(1)->links() }}
	@endif
</div>
