<style>
    table,
    th,
    td {
        border: 1px solid black;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table table-bordered book_datatable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>SmallThumbnail</th>
                                <th>Author</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script type="text/javascript">
    $(function() {
        var table = $('.book_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('book.list') }}",
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'small_thumbnail',
                    name: 'small_thumbnail',
                    render: function(data, type, full, meta) {
                        return "<img src=" + data + " height='100' width='70' alt='No image available!' />";
                    },
                    orderable: false,
                    searchable: false

                },
                {
                    data: 'authors',
                    name: 'authors'
                },
            ]
        });
    });
</script>
