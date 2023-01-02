<div>
    @include('livewire.admin.brand.modal-form')
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span class="pt-2">Brand List</span>
                        <a href="#" wire:click="closeOrOpenModal" class="btn btn-primary btn-sm"
                            data-bs-toggle="modal" data-bs-target="#AddBrandModal">Add Brands</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $brandid = $brands->currentPage(); ?>
                            @forelse ($brands as $brand)
                                <tr>
                                    <td>{{ $brand->id }}</td>


                                    <td>{{ $brand->name }} </td>
                                    <td>{{ $brand->slug }} </td>
                                    <td>{{ $brand->status == true ? 'Hidden' : 'Visible' }} </td>
                                    <td>
                                        <a href="#" wire:click="editBrand({{ $brand->id }})"
                                            data-bs-toggle="modal" data-bs-target="#UpdateBrandModal"
                                            class="btn btn-success btn-sm">Edit</a>

                                        <a href="#" wire:click="deleteBrand({{ $brand->id }})" data-bs-toggle="modal" data-bs-target="#DeleteBrandModal"
                                            class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center"> No Brands Found </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $brands->links() }}
                </div>
            </div>
        </div>
    </div>

</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {

            $("#AddBrandModal").modal('hide')
            $("#UpdateBrandModal").modal('hide')
            $("#DeleteBrandModal").modal('hide')
        })
    </script>
@endpush
