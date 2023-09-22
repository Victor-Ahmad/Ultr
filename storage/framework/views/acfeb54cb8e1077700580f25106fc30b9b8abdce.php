<?php $__env->startSection('sub-header'); ?>
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">

            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 py-2">
                                <li class="breadcrumb-item"><a
                                        href="<?php echo e(route('dashboard.home')); ?>"><?php echo e(__('dash.home')); ?></a></li>
                                <li class="breadcrumb-item active" aria-current="page">تقرير المبيعات</li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>


        </header>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="col-md-12  mb-3">
                        <div class="row">
                            <div class="col-md-1">
                                <label for="inputEmail4"><?php echo e(__('dash.date')); ?></label>
                            </div>
                            <div class="col-md-4">
                                <input type="datetime-local" name="date" class="form-control date" step="1"
                                       id="inputEmail4">
                            </div>


                            <div class="col-md-1">
                                <label for="inputEmail4">طريقه الدفع</label>
                            </div>
                            <div class="col-md-4">
                                <select class="select2 payment_method form-control" name="payment_method">
                                    <option selected disabled>اختر</option>
                                    <option value="cache">كاش</option>
                                    <option value="wallet">محفظة</option>
                                    <option value="visa">مدي</option>
                                </select>
                            </div>

                        </div>

                    </div>
                    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>رقم الطلب</th>
                            <th>اسم العميل</th>
                            <th>القسم</th>
                            <th>عدد الخدمات</th>
                            <th>المبلغ</th>
                            <th>طريقة الدفع</th>
                        </tr>
                        </thead>
                    </table>


                </div>

                <table class="table table-bordered nowrap">

                    <thead>

                    <tr>
                        <th width="50%">إجمالي المبيعات بدون ضريبة</th>
                        <td><?php echo e($sub_total ?? 0); ?></td>
                    </tr>

                    <tr>
                        <th>إجمالي الضريبة %15</th>
                        <td><?php echo e($tax); ?></td>
                    </tr>

                    <tr>
                        <th>إجمالي المبيعات</th>
                        <td><?php echo e($tax + $sub_total); ?></td>
                    </tr>

                    </thead>

                </table><!-- end of table -->
            </div>

        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#html5-extension').DataTable({
                dom: "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
                    "<'table-responsive'tr>" +
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                order: [[0, 'desc']],
                "language": {
                    "url": "<?php echo e(app()->getLocale() == 'ar'? '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json' : '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json'); ?>"
                },
                buttons: {
                    buttons: [
                        {extend: 'copy', className: 'btn btn-sm'},
                        {extend: 'csv', className: 'btn btn-sm'},
                        {extend: 'excel', className: 'btn btn-sm'},
                        {extend: 'print', className: 'btn btn-sm'}
                    ]
                },
                processing: true,
                serverSide: true,
                ajax: '<?php echo e(route('dashboard.report.sales')); ?>',
                columns: [
                    {data: 'order_number', name: 'order_number',orderable: true, searchable: true},
                    {data: 'user_name', name: 'user_name',orderable: true, searchable: true},
                    {data: 'category', name: 'category',orderable: true, searchable: true},
                    {data: 'service_number', name: 'service_number',orderable: true, searchable: true},
                    {data: 'price', name: 'price',orderable: true, searchable: true},
                    {data: 'payment_method', name: 'payment_method',orderable: true, searchable: true},


                ]
            });
            $('.date').change(function(){
                var date = $('.date').val();
                table.ajax.url( '<?php echo e(route('dashboard.report.sales')); ?>?date=' + date ).load();
            })
            $('.payment_method').change(function(){
                var payment_method = $('.payment_method').val();
                table.ajax.url( '<?php echo e(route('dashboard.report.sales')); ?>?payment_method='+payment_method ).load();
            })
        });

    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('dashboard.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\sahmTech\Altra\resources\views/dashboard/reports/sales.blade.php ENDPATH**/ ?>