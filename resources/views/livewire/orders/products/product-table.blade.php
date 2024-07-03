<div>
    <div class="card">
        <div class="row">
            <div class="col">
                <h5 class="card-header">Product</h5>
            </div>
            <div class="col">
                <h5 class="card-header text-end">
                    <button type="button" class="btn btn-primary" wire:click="openModal()" data-bs-toggle="modal"
                        data-bs-target="#modalCenter">
                        Create Product
                    </button>
                </h5>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Prev Img</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($products as $key => $product)
                        <tr>


                            <td>{{ $product->id }}</td>
                            <td><img width="50px" height="50px"
                                    src="{{ asset('/storage/' . $product->product_img) }}" />
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu" wire:click="$refresh">
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#modalCenter"
                                            wire:click.prevent="openModal('{{ $product->uuid }}')"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <!-- Button trigger modal -->
                                        <a class="dropdown-item" href="javascript:void(0);"
                                            wire:click.prevent="delete('{{ $product->uuid }}')"
                                            wire:confirm="Are you sure you want to delete this product?">
                                            <i class="bx bx-trash me-1"></i>
                                            Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-lg-4 col-md-6">
                <div class="mt-3">
                    <!-- Modal -->
                    <div class="modal fade" id="modalCenter"
                        {{ $task ? " style='display: block;'' aria-modal='true'" : 'tabindex="-1" aria-hidden="true"' }}>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Create Edit Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form wire:submit.prevent="save" enctype="multipart/form-data">
                                    <input type="hidden" name="uuid" id="uuid" wire:model="uuid">

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="name" class="form-label">Product Name</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    placeholder="Enter Product Name" wire:model="name">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="category" class="form-label">Product Category</label>
                                                <input type="text" name="category" id="category"
                                                    class="form-control" placeholder="Enter Product Category"
                                                    wire:model="category">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="description" class="form-label">Product Description</label>
                                                <textarea name="description" id="description" class="form-control" placeholder="Enter Product Description"
                                                    wire:model="description">{{ $description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="price" class="form-label">Product Price</label>
                                                <input type="number" name="price" id="price" class="form-control"
                                                    placeholder="Enter Product Price" wire:model="price">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <h6 class="mb-1">Transfer Receipt
                                                </h6>
                                                <figure class="image-upload">
                                                    <img id="logo"
                                                        src="{{ asset('/assets/img/elements/upload-file.svg') }}"
                                                        alt="" srcset="">
                                                    <input name="product_img" id="product_img"
                                                        wire:model="product_img" type="file" accept="image/*"
                                                        oninput="handleFileInput(this);" />
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary"
                                            data-bs-dismiss="modal">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function handleFileInput(input) {
                var file = input.files[0];

                // Set the image source
                var logo = document.getElementById('logo');
                logo.src = window.URL.createObjectURL(file);
                logo.parentElement.setAttribute('data-before', file.name);

                // Get the modal element
                var modal = document.getElementById('modalCenter');

                // Add style and aria attributes
                modal.style.display = 'block';
                modal.setAttribute('aria-modal', 'true');
                modal.classList.add('show');

                // Optionally add more aria attributes or other styles
            }

            $(document).ready(function() {

                // const nameElement = $("#name");
                // const categoryElement = $("#category");
                // const descriptionElement = $("#description");
                // const priceElement = $("#price");
                const confirmButtonColor = "#3a57e8";

                // window.addEventListener('closeModal', event => {
                //     const {
                //         address,
                //         email,
                //         phone_number
                //     } = event.detail.account;
                //     addressElement.text(address);
                //     emailElement.text(email);
                //     phoneElement.text(phone_number);

                // Swal.fire({
                //     icon: 'success',
                //     title: 'Done',
                //     text: 'Account Updated',
                //     confirmButtonColor: confirmButtonColor
                // });
                // });
                @if (Session::has('message'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Done',
                        text: 'Product Saved Sucessfully',
                        confirmButtonColor: confirmButtonColor
                    });
                @endif

                window.addEventListener('error', event => {
                    const errors = event.detail.errors;
                    const errorMessage = errors.join(', ');
                    const updatedString = removeAllExceptLast(errorMessage, '.');
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!!!',
                        text: updatedString,
                        confirmButtonColor: confirmButtonColor
                    });
                });


                function removeAllExceptLast(str, charToRemove) {
                    const lastIndex = str.lastIndexOf(charToRemove);

                    if (lastIndex === -1) {
                        // If the character is not found, return the original string
                        return str;
                    }
                    const beforeLast = str.slice(0, lastIndex);
                    const afterLast = str.slice(lastIndex);
                    const cleanedBeforeLast = beforeLast.split(charToRemove).join('');
                    return cleanedBeforeLast + afterLast;
                }
            });
        </script>
    </div>
</div>
