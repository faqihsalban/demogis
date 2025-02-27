<x-app-layout>
    <x-slot name="header">
        <h1 class="pb-0">Asset Management</h1>
        <div class="top-right-button-container">

            <a href="{{route('space.create')}}" class="btn btn-primary top-right-button mr-1"> Add Spaces</a>
        </div>
        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
            <ol class="breadcrumb pt-0 pb-0">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Management</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Spaces</li>
            </ol>
        </nav>
    </x-slot>
    <div class="card mb-5">
        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-4">
                    {{-- <form class="form" action="{{route('space.import')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="form-row">
                                <div class="form-group col-9">
                                    <span>File</span>
                                    <div>
                                        <input type="file" class="form-control" name="file" required>
                                    </div>
                                </div>
                                <div class="form-group col-1">
                                    <span>Clear Food ?</span>
                                    <div>
                                        <div class="custom-switch custom-switch-primary mb-2"><input class="custom-switch-input" id="switch" type="checkbox" name="clear"> <label class="custom-switch-btn" for="switch"></label></div>
                                    </div>
                                </div>
                                <div class="form-group col-2">
                                    <span>Action</span>
                                    <div>
                                        <button  type="submit" class="btn btn-primary">Import</button>
                                        <a href="{{route('food.export')}}" type="button" class="btn btn-info ">Export</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
                    <table id="datatableMain" class="data-table responsive nowrap" data-order="[[ 0, &quot;desc&quot; ]]">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kategori</th>
                            <th>Nama Layer</th>
                            <th>Warna</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Food</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" action="{{route('space.store')}}" method="POST" enctype="multipart/form-data" id="add-form">
                                    {{ csrf_field() }}
                                    <div class="form-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <label for="name_add" class="form-label">Name</label>
                                                    <input type="text" class="form-control" name="name" required id="name_add">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="base_portion_add" class="form-label">Base Portion Per Dish</label>
                                                    <input type="number" class="form-control"  name="base_portion" placeholder ="in Gram" id="base_portion_add">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="status-select-add" class="form-label">Status</label>
                                                    <select class="form-control select2" name="status" required style="width: 100%" id="status-select-add" >
                                                        <option value="1">Enable</option>
                                                        <option value="0">Disable</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="source-select-add" class="form-label">Source</label>
                                                    <input type="text" class="form-control" name="source" required id="source-select-add">

                                                    {{-- <select class="form-control select2" name="source[]" multiple required style="width: 100%" id="source-select-add" >
                                                        <option value="Nutrisurvey">NutriSurvey</option>
                                                        <option value="FAO">FAO</option>
                                                        <option value="Australian Food Composition Database">Australian Food Composition Database</option>
                                                        <option value="recomen">Recomendation</option>
                                                    </select> --}}
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <span>Energy</span>
                                                    <input type="number" class="form-control" min="0" name="energy"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Carbo</span>
                                                    <input type="number" class="form-control" min="0" name="carbo"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Fat</span>
                                                    <input type="number" class="form-control" min="0" name="fat"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Protein</span>
                                                    <input type="number" class="form-control" min="0" name="protein"  required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <span>Fiber</span>
                                                    <input type="number" class="form-control" min="0" name="fiber"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Fat Acid Sat</span>
                                                    <input type="number" class="form-control" min="0" name="fat_acid_sat"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Fat Acid Unsat</span>
                                                    <input type="number" class="form-control" min="0" name="fat_acid_unsat"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Cholesterol</span>
                                                    <input type="number" class="form-control" min="0" name="cholesterol"  required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <span>Uric Acid</span>
                                                    <input type="number" class="form-control" min="0" name="uric_acid"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Purine n</span>
                                                    <input type="number" class="form-control" min="0" name="purine_n"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Iron</span>
                                                    <input type="number" class="form-control" min="0" name="iron"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Calcium</span>
                                                    <input type="number" class="form-control" min="0" name="calcium"  required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <span>Zinc</span>
                                                    <input type="number" class="form-control" min="0" name="zinc"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Vit C</span>
                                                    <input type="number" class="form-control" min="0" name="vit_c"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Vit D</span>
                                                    <input type="number" class="form-control" min="0" name="vit_d"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Vit E</span>
                                                    <input type="number" class="form-control" min="0" name="vit_e"  required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <span>Magnesium</span>
                                                    <input type="number" class="form-control" min="0" name="magnesium"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Sodium</span>
                                                    <input type="number" class="form-control" min="0" name="sodium"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Potassium</span>
                                                    <input type="number" class="form-control" min="0" name="potassium"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Chlorine</span>
                                                    <input type="number" class="form-control" min="0" name="chlorine"  required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <span>Water</span>
                                                    <input type="number" class="form-control" min="0" name="water"  required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <span>Gas Emission</span>
                                                    <input type="number" class="form-control" min="0" name="gas_emission"  required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <span>Country </span>
                                                    <input type="text" class="form-control" name="country" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12 ">
                                                    <span>Image</span>
                                                    <div class="form-group">
                                                        <input accept="image/*" type="file" class="form-control" name="picture">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <span>How to</span>
                                                    <textarea name="how_to" id="txt-how_to-show"></textarea>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <span>Ingredients</span>
                                                    <textarea name="ingredients" id="txt-ingredients-add"></textarea>
                                                </div>
                                            </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add -->

    <!-- Modal Edit -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="max-width: 80%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                    <form class="form form-horizontal" action="{{route('space.update',0)}}" method="POST" enctype="multipart/form-data" id="edit-form">
                                        <input type="hidden" name="_method" value="put" />
                                        {{ csrf_field() }}
                                        <div class="form-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-2">
                                                    <span>ID</span>
                                                    <input type="number" class="form-control" name="id" readonly>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <span>Source ID</span>
                                                    <input type="text" class="form-control" name="source_id">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <span>Name</span>
                                                    <input type="text" class="form-control" name="name" required>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <span>Base Portion Per Dish</span>
                                                    <input type="number" class="form-control" name="base_portion"  required>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="status-select-add" class="form-label">Status</label>
                                                    <select class="form-control select2" name="status" required style="width: 100%" id="status-select-edit" >
                                                        <option value="1">Enable</option>
                                                        <option value="0">Disable</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="source-select-edit" class="form-label">Source</label>
                                                    <input type="text" class="form-control" name="source" required id="source-select-edit">

                                                    {{-- <select class="select2 form-control" name="source[]" id="source-select-edit" style="width: 100%"  multiple>
                                                        <option value="Nutrisurvey">NutriSurvey</option>
                                                        <option value="FAO">FAO</option>
                                                        <option value="Australian Food Composition Database">Australian Food Composition Database</option>
                                                        <option value="recomen">Recomendation</option>
                                                    </select> --}}
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <span>Energy</span>
                                                    <input type="number" class="form-control" min="0" name="energy"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Carbo</span>
                                                    <input type="number" class="form-control" min="0" name="carbo"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Fat</span>
                                                    <input type="number" class="form-control" min="0" name="fat"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Protein</span>
                                                    <input type="number" class="form-control" min="0" name="protein"  required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <span>Fiber</span>
                                                    <input type="number" class="form-control" min="0" name="fiber"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Fat Acid Sat</span>
                                                    <input type="number" class="form-control" min="0" name="fat_acid_sat"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Fat Acid Unsat</span>
                                                    <input type="number" class="form-control" min="0" name="fat_acid_unsat"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Cholesterol</span>
                                                    <input type="number" class="form-control" min="0" name="cholesterol"  required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <span>Uric Acid</span>
                                                    <input type="number" class="form-control" min="0" name="uric_acid"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Purine n</span>
                                                    <input type="number" class="form-control" min="0" name="purine_n"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Iron</span>
                                                    <input type="number" class="form-control" min="0" name="iron"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Calcium</span>
                                                    <input type="number" class="form-control" min="0" name="calcium"  required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <span>Zinc</span>
                                                    <input type="number" class="form-control" min="0" name="zinc"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Vit C</span>
                                                    <input type="number" class="form-control" min="0" name="vit_c"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Vit D</span>
                                                    <input type="number" class="form-control" min="0" name="vit_d"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Vit E</span>
                                                    <input type="number" class="form-control" min="0" name="vit_e"  required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <span>Magnesium</span>
                                                    <input type="number" class="form-control" min="0" name="magnesium"  required>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <span>Sodium</span>
                                                    <input type="number" class="form-control" min="0" name="sodium"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Potassium</span>
                                                    <input type="number" class="form-control" min="0" name="potassium"  required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <span>Chlorine</span>
                                                    <input type="number" class="form-control" min="0" name="chlorine"  required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <span>Water</span>
                                                    <input type="number" class="form-control" min="0" name="water"  required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <span>Gas Emission</span>
                                                    <input type="number" class="form-control" min="0" name="gas_emission"  required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <span>Country </span>
                                                    <input type="text" class="form-control" name="country" >
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12 ">
                                                    <span>Image</span>
                                                    <div class="input-group mb-3">
                                                        <input accept="image/*" type="file" class="form-control" name="picture">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="button" data-toggle="collapse" href="#collapseExample2"
                                                                    role="button" aria-expanded="true" aria-controls="collapseExample2">Preview</button>
                                                        </div>
                                                    </div>
                                                    <div class="collapse" id="collapseExample2">
                                                        <div class="p-4 border mt-4">
                                                            <img id="picture_edit" src="https://eatsup.sgp1.digitaloceanspaces.com/content/RfRZuYGv46P8G8sWezG2LGVygQlE50grjjhhaPnv.png" class="responsive border-0 card-img-top mb-3" style="
                                                                        max-width: 400px;
                                                                            display: block;
                                                                            margin-left: auto;
                                                                            margin-right: auto;
                                                                            width: 50%;
                                                                        ">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <span>How to</span>
                                                    <textarea name="how_to" class="txt-ingredients" id="txt-how_to-edit"></textarea>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <span>Ingredients</span>
                                                    <textarea name="ingredients" class="txt-ingredients" id="txt-ingredients-edit"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <div class="lock-modal"></div>
                                        <div class="loading-circle"></div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edit -->

    @section('title','Food')
    @push('style')
        <link rel="stylesheet" href="{{asset('admin/css/vendor/dataTables.bootstrap4.min.css')}}" />
        <link rel="stylesheet" href="{{asset('admin/css/vendor/datatables.responsive.bootstrap4.min.css')}}" />
        <link rel="stylesheet" href="{{asset('admin/css/vendor/bootstrap-float-label.min.css')}}" />
        <link rel="stylesheet" href="{{asset('admin/css/vendor/select2.min.css')}}" />
        <link rel="stylesheet" href="{{asset('admin/css/vendor/select2-bootstrap.min.css')}}" />
        <style>
                ul {
                    margin: 20px;
                }
                .input-color {
                    position: relative;
                }
                .input-color input {
                    padding-left: 20px;
                }
                .input-color .color-box {
                    width: 50%;
                    height: 30px;
                    display: inline-block;
                    background-color: #ccc;
                    left: 5px;
                    top: 5px;
                }
            </style>
    @endpush
    @push('script')
        <script src="{{asset('admin/js/vendor/jquery.validate/jquery.validate.min.js')}}"></script>
        <script src="{{asset('admin/js/vendor/jquery.validate/additional-methods.min.js')}}"></script>
        <script src="{{asset('admin/js/vendor/datatables.min.js')}}"></script>
        <script src="{{asset('admin/js/vendor/select2.full.js')}}"></script>
        <script src="{{asset('admin/js/tinymce/tinymce.min.js')}}" ></script>
        <script>tinymce.init({selector:'textarea'});</script>
        <script>

            var dataTable;
            $(document).ready(function () {
                $('.select2').select2({
                    width: 'resolve'
                });
                dataTable = $('#datatableMain').DataTable({
                    "responsive": true,
                    "processing": true,
                    "serverSide": true,
                    "bInfo" : true,
                    "ajax": {
                    "url": "{{ url('admin/space/datatable') }}",
                        "dataType": "json",
                        "type": "POST",
                        "headers": {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        error: function (err) {
                            console.log(err);
                        }
                    },
                    "columns": [
                        {"data": "id"},
                        {"data": "category"},
                        {"data": "name"},
                        {"data": "color",
                        "render": function (data, type, full) {
                            return `<div class="input-color"> <div class="color-box" style="background-color: `+ data +`;"></div> </div>`;
                        }},
                        {"data": "type"},
                        {"data": "action"}
                    ],
                        "destroy": true
                });
                $("form#add-form").submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        url: document.getElementById("add-form").action,
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (hasil) {
                            $('#add-modal').modal('toggle');
                            dataTable.ajax.reload(null, false);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Data successfully saved!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        },
                        error: function (err) {
                            console.log(err);
                        },
                    });
                });
                $("form#edit-form").submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        url: document.getElementById("edit-form").action,
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (hasil) {
                            $('#edit-modal').modal('toggle');
                            dataTable.ajax.reload(null, false);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Data successfully saved!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        },
                        error: function (err) {
                            console.log(err);
                        },
                    });
                });
            });
            function showData(id) {
                $('#show-modal').modal('show');
                modalLoading("show-modal","show");
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: '{{url("admin/space")}}/' + id,
                    error: function (err) {
                        console.log(err);
                        // swal("Error!", "Failed to get Data.", "error");
                        modalLoading("show-modal","hide");
                    },
                    dataType: 'json',
                    success: function (data) {
                        for (const [key, value] of Object.entries(data.data)) {
                            element = document.querySelector("form[id='show-form'] input[name='"+key+"']");
                            if(value != null) {
                                if (element != null) {
                                    if (['picture','file'].includes(key)) {
                                        //TODO kalo image langsung tampilin
                                        $('#'+key+'_show').attr("src", value)
                                    } else {
                                        element.value = value;
                                    }
                                } else {
                                    if (['category'].includes(key)) {
                                        element = document.querySelector("form[id='show-form'] select[name='" + key + "']").value = value;
                                    }else if (['status'].includes(key)) {
                                        $('#status-select-show').val(value).change();
                                    }else if(['portion'].includes(key)){
                                        var porsi = [];
                                        data.data.portion.forEach(value => {
                                            porsi.push(value.id);
                                        });
                                        $('#portion-select-show').val(porsi).change();
                                    } else if (['how_to', 'ingredients'].includes(key)) {
                                        console.log("ket",'txt-' + key + '-show')
                                        tinyMCE.get('txt-' + key + '-show').setContent(value);
                                        tinyMCE.get('txt-' + key + '-show').setMode("readonly");
                                    }
                                }
                            }
                        }
                        modalLoading("show-modal","hide");

                    }, complete: function () {
                        modalLoading("show-modal","hide");
                    },
                    type: 'GET'
                });
            }
            function editData(id) {
                    $('#edit-modal').modal('show');
                     modalLoading("edit-modal","show");
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        url: '{{url("admin/space")}}/' + id,
                        error: function (err) {
                            console.log(err);
                            swal("Error!", "Failed to get Data.", "error");
                            modalLoading("edit-modal","hide");
                        },
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
                            document.getElementById("edit-form").action = '{{url("admin/space")}}/' + data.data.id;
                            $('#category-select-edit').val('').trigger('change');
                            // $('#source-select-edit').val('').trigger('change');
                            $('#status-select-edit').val('').trigger('change');
                            $('#portion-select-edit').val('').trigger('change');

                            for (const [key, value] of Object.entries(data.data)) {
                                if(value != null){
                                    element = document.querySelector("form[id='edit-form'] input[name='"+key+"']");
                                    if(element!= null) {
                                        if (['picture','file'].includes(key)) {
                                            //TODO kalo image langsung tampilin
                                            $('#'+key+'_edit').attr("src", value)
                                        }else{
                                            element.value = value;
                                        }
                                    }else{
                                        if (['category'].includes(key)) {
                                            var cate = data.data.category.split(';');
                                            $('#category-select-edit').val(cate).change();
                                            $('#category-select-edit').val(cate).change();
                                        }
                                        // else if (['source'].includes(key)) {
                                        //     var source = data.data.source.split(';');
                                        //     $('#source-select-edit').val(source).change();
                                        // }
                                        else if (['status'].includes(key)) {
                                            $('#status-select-edit').val(value).change();
                                        }
                                        else if(['portion'].includes(key)){
                                            var porsi = [];
                                            data.data.portion.forEach(value => {
                                                porsi.push(value.id);
                                            });
                                            $('#portion-select-edit').val(porsi).change();
                                        }
                                        else if (['how_to', 'ingredients'].includes(key)) {
                                            console.log('txt-'+key+'-edit');
                                            tinyMCE.get('txt-'+key+'-edit').setContent(value);
                                        }
                                    }
                                }

                            }
                            modalLoading("edit-modal","hide");

                        },
                        complete: function () {
                            modalLoading("edit-modal","hide");
                        },
                        type: 'GET'
                    });
            }
            function deleteData(id) {
                    if (confirm("Are you sure want to delete!")) {
                        $.ajax({
                            url: '{{url("admin/space")}}/' + id,
                            type: 'DELETE',
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            success: function (data) {
                                dataTable.ajax.reload(null, false);
                                // if (data == null) {
                                //     location.reload();
                                // } else {
                                //     alert("Not Deleted! ");
                                // }
                            },
                            error: function (e) {
                                alert("Error!, Failed to delete.,  ");
                            }
                        });
                    }
            }

        </script>
    @endpush
</x-app-layout>
