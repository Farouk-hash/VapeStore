<!-- Category Edit Modal -->
<div class="modal fade" id="edit{{ $category->id }}" tabindex="-1" role="dialog"
     aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">
                    <i class="fas fa-edit me-2"></i>
                    Edit Category: {{ $category->name }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('categories.update', $category->id) }}" method="post" autocomplete="off">
                @method('PUT')
                @csrf
                
                <div class="modal-body">
                    <!-- Category Name -->
                    <div class="form-group">
                        <label for="name{{ $category->id }}" class="font-weight-bold">
                            <i class="fas fa-tag me-1"></i>Category Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name{{ $category->id }}" 
                               class="form-control" 
                               value="{{ old('name', $category->name) }}" 
                               placeholder="Enter category name" 
                               required>
                        <small class="form-text text-muted">Enter a unique category name</small>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description{{ $category->id }}" class="font-weight-bold">
                            <i class="fas fa-align-left me-1"></i>Description
                        </label>
                        <textarea name="description" 
                                  id="description{{ $category->id }}" 
                                  class="form-control" 
                                  rows="4" 
                                  placeholder="Enter category description (optional)">{{ old('description', $category->description) }}</textarea>
                        <small class="form-text text-muted">Brief description of the category</small>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="is_active{{ $category->id }}" class="font-weight-bold">
                            <i class="fas fa-toggle-on me-1"></i>Status <span class="text-danger">*</span>
                        </label>
                        <select class="form-control" 
                                id="is_active{{ $category->id }}" 
                                name="is_active" 
                                required>
                            <option value="" disabled>--Choose Status--</option>
                            <option value="1" {{ old('is_active', $category->is_active) == 1 ? 'selected' : '' }}>
                                <i class="fas fa-check-circle text-success"></i>Active
                            </option>
                            <option value="0" {{ old('is_active', $category->is_active) == 0 ? 'selected' : '' }}>
                                <i class="fas fa-times-circle text-danger"></i>Inactive
                            </option>
                        </select>
                        <small class="form-text text-muted">
                            Current status: 
                            @if($category->is_active)
                                <span class="badge badge-success">
                                    <i class="fas fa-check-circle me-1"></i>Active
                                </span>
                            @else
                                <span class="badge badge-secondary">
                                    <i class="fas fa-times-circle me-1"></i>Inactive
                                </span>
                            @endif
                        </small>
                    </div>

                    <!-- Category Info Card (Optional) -->
                    <div class="card bg-light border-0 mt-3">
                        <div class="card-body py-2">
                            <div class="row text-sm">
                                <div class="col-sm-6">
                                    <strong class="text-muted">Created:</strong>
                                    <span>{{ $category->created_at }}</span>
                                </div>
                                <div class="col-sm-6">
                                    <strong class="text-muted">Last Updated:</strong>
                                    <span>{{ $category->updated_at }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden ID field -->
                    <input type="hidden" name="id" value="{{ $category->id }}">
                </div>
                
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i>Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

