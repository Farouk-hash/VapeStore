<!-- Brand Edit Modal -->
<div class="modal fade" id="edit{{ $brand->id }}" tabindex="-1" role="dialog"
     aria-labelledby="editBrandModalLabel{{ $brand->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editBrandModalLabel{{ $brand->id }}">
                    <i class="fas fa-edit me-2"></i>
                    Edit Brand: {{ $brand->name }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('brands.update', $brand->id) }}" method="post" autocomplete="off">
                @method('PUT')
                @csrf
                
                <div class="modal-body">
                    <!-- Brand Name -->
                    <div class="form-group">
                        <label for="name{{ $brand->id }}" class="font-weight-bold">
                            <i class="fas fa-tag me-1"></i>Brand Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name{{ $brand->id }}" 
                               class="form-control" 
                               value="{{ old('name', $brand->name) }}" 
                               placeholder="Enter brand name" 
                               required>
                        <small class="form-text text-muted">Enter the official brand name</small>
                    </div>

                    <!-- Country -->
                    <div class="form-group">
                        <label for="country{{ $brand->id }}" class="font-weight-bold">
                            <i class="fas fa-globe me-1"></i>Country
                        </label>
                        <input type="text" 
                               name="country" 
                               id="country{{ $brand->id }}" 
                               class="form-control" 
                               value="{{ old('country', $brand->country) }}" 
                               placeholder="Enter country of origin">
                        <small class="form-text text-muted">Country where the brand originates</small>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description{{ $brand->id }}" class="font-weight-bold">
                            <i class="fas fa-align-left me-1"></i>Description
                        </label>
                        <textarea name="description" 
                                  id="description{{ $brand->id }}" 
                                  class="form-control" 
                                  rows="3" 
                                  placeholder="Enter brand description">{{ old('description', $brand->description) }}</textarea>
                        <small class="form-text text-muted">Brief description about the brand</small>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="is_active{{ $brand->id }}" class="font-weight-bold">
                            <i class="fas fa-toggle-on me-1"></i>Status <span class="text-danger">*</span>
                        </label>
                        <select class="form-control" 
                                id="is_active{{ $brand->id }}" 
                                name="is_active" 
                                required>
                            <option value="" disabled>--Choose Status--</option>
                            <option value="1" {{ old('is_active', $brand->is_active) == 1 ? 'selected' : '' }}>
                                <i class="fas fa-check-circle text-success"></i>Active
                            </option>
                            <option value="0" {{ old('is_active', $brand->is_active) == 0 ? 'selected' : '' }}>
                                <i class="fas fa-times-circle text-danger"></i>Inactive
                            </option>
                        </select>
                        <small class="form-text text-muted">
                            Current status: 
                            @if($brand->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                        </small>
                    </div>

                    <!-- Hidden ID field -->
                    {{-- <input type="hidden" name="id" value="{{ $brand->id }}"> --}}
                </div>
                
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Update Brand
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
