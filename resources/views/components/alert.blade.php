<div>
    {{ $slot }}

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let alert = document.querySelector('#alert');
            setTimeout(() => {
                alert.remove();
            }, 3000);
        });
    </script>
</div>
