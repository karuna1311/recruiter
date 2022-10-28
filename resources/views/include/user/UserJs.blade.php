<footer class="footer">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-6">
            <script>document.write(new Date().getFullYear())</script> CET CELL
         </div>
      </div>
   </div>
</footer>
<script src="{{ url('/') }}/LoginAssets/js/vendor.min.js"></script>
<script src="{{ url('/') }}/LoginAssets/js/app.min.js"></script>
<!-- Apex js -->
<script src="{{ url('/') }}/LoginAssets/js/vendor/apexcharts.min.js"></script>
<script src="{{ url('/') }}/assets/js/toastr.min.js"></script>
<script src="{{ url('/') }}/assets/js/moment.js"></script>
<script src="{{ url('/') }}/assets/js/jquery.validate.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script type="text/javascript">
	$('.select2').select2();

//    $(function() {
//          let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
//          let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
//          let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
//          let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
//          let printButtonTrans = '{{ trans('global.datatables.print') }}'
//          let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'

//             let languages = {
//                'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
//             };

//             $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
//             $.extend(true, $.fn.dataTable.defaults, {
//                language: {
//                   url: languages['{{ app()->getLocale() }}']
//                },
//                columnDefs: [{
//                   orderable: false,
//                   className: 'select-checkbox',
//                   targets: 0
//                }, {
//                   orderable: false,
//                   searchable: false,
//                   targets: -1
//                }],
//                select: {
//                   style:    'multi+shift',
//                   selector: 'td:first-child'
//                },
//                order: [],
//                scrollX: true,
//                pageLength: 100,
//                dom: 'lBfrtip<"actions">',
//                buttons: [
//                   {
//                   extend: 'copy',
//                   className: 'btn-default',
//                   text: copyButtonTrans,
//                   exportOptions: {
//                      columns: ':visible'
//                   }
//                   },
//                   {
//                   extend: 'csv',
//                   className: 'btn-default',
//                   text: csvButtonTrans,
//                   exportOptions: {
//                      columns: ':visible'
//                   }
//                   },
//                   {
//                   extend: 'excel',
//                   className: 'btn-default',
//                   text: excelButtonTrans,
//                   exportOptions: {
//                      columns: ':visible'
//                   }
//                   },
//                   {
//                   extend: 'pdf',
//                   className: 'btn-default',
//                   text: pdfButtonTrans,
//                   exportOptions: {
//                      columns: ':visible'
//                   }
//                   },
//                   {
//                   extend: 'print',
//                   className: 'btn-default',
//                   text: printButtonTrans,
//                   exportOptions: {
//                      columns: ':visible'
//                   }
//                   },
//                   {
//                   extend: 'colvis',
//                   className: 'btn-default',
//                   text: colvisButtonTrans,
//                   exportOptions: {
//                      columns: ':visible'
//                   }
//                   }
//                ]
//             });

//             $.fn.dataTable.ext.classes.sPageButton = '';
// });

</script>