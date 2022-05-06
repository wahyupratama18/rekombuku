<div class="flex items-center gap-x-3">
    {{ $slot ?? '' }}

    <a href="{{ $route->edit }}" title="Edit">
        <i class="mdi mdi-circle-edit-outline text-yellow-400"></i>
    </a>
    
    <form method="post" action="{{ $route->destroy }}" x-data>
        @csrf
        @method('DELETE')
        <i
        title="Hapus"
        class="mdi mdi-trash-can cursor-pointer text-red-400"
        @click="
            Swal.fire({
                text: 'Apakah anda yakin ingin menghapusnya?',
                icon: 'warning',
                showCancelButton: true,
                reverseButtons: true
            }).then(val => {
                if (val.value) {
                    $root.submit();
                }
            })
        "></i>
    </form>
</div>