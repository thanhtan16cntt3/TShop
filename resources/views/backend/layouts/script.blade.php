    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/backend/admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/backend/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/backend/admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/backend/admin/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    {{-- <script src="{{ asset('assets/backend/admin/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/backend/admin/js/demo/chart-pie-demo.js') }}"></script> --}}
    <script>
        setTimeout(function(){
          $('.alert').slideUp();
        },4000);
    </script>

    @stack('scripts')
