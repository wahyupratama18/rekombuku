<x-action :route="$route">
    <a href="{{ route('students.index').'?table[filters][program_studi][0]='.$id }}" title="Data Mahasiswa">
        <i class="mdi mdi-account"></i>
    </a>
</x-action>