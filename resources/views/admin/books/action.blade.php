<x-action :route="$route">
    <form method="POST" action="{{ route('books.items.store', $book) }}" x-data>
    @csrf
    <input type="hidden" name="qty" x-ref="qty">
        <i
            class="mdi mdi-plus-circle-outline cursor-pointer"
            title="Tambah Kuantitas Buku"
            @click="
            Swal.fire({
                text: 'Berapakah jumlah buku baru?',
                icon: 'question',
                input: 'number',
                showCancelButton: true,
                reverseButtons: true
            }).then(val => {
                if (val.value) {
                    $refs.qty.value = val.value
                    $root.submit();
                }
            })
            ">
        </i>
    </form>

    <a href="{{ route('books.show', $book) }}" title="Tinjau">
        <i class="mdi mdi-eye"></i>
    </a>
</x-action>