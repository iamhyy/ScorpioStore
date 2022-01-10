@extends('admin_layout')
@section('cate_prod')
<div class="container-fluid">
	<style type="text/css">
		p.title_statistic{
			text-align: center;
			font-size: 20px;
			font-weight: bold;
		}
	</style>
	<div class="row">
		<p class="title_statistic">Statistic</p>
		<form autocomplete="off">
			@csrf
			<div class="col-md-2">
				<p>Start date: <input type="text" id="datepicker" class="form-control" name=""></p>
				<input type="button" id="btn-statistic-filter" name="" class="btn  btn-primary btn-sm btn-statistic-filter" value="filter results">
			</div>
			<div class="col-md-2">
				<p>End date: <input type="text" id="datepicker2" class="form-control" name=""></p>
			</div>
			
			<div class="col-md-2">
				<p>Filter by: 
					<select class="statistic_filter form-control">
						<option disabled selected hidden>--Choose--</option>
						<option value="7day">7 days</option>
						<option value="lmonth">Last month</option>
						<option value="tmonth">This month</option>
						<option value="365day">365 days </option>
					</select>
				</p>
			</div>
		</form>
		<div class="col-md-12"><p class="title_statistic">Sales chart</p></div>
		<div class="col-md-12">
			<div id="chart" class="chart" style="height: 250px;"> </div>
		</div>
		<div class="col-md-12"><p class="title_statistic">Brand and category chart</p></div>
		<div class="col-md-6">
			<div id="chart2" class="chart2" style="height: 250px;"> </div>
		</div>
		<div class="col-md-6">
			<div id="chart3" class="chart3" style="height: 250px;"> </div>
		</div>

	</div>

	<form action="{{URL::to('/admin/export-excel')}}" method="POST">
          @csrf
       <input type="submit" value="Export " name="export_statistic" class="btn btn-success">
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        
        var chart2 = new Morris.Donut({
            element: 'chart2',
            data: [
                <?php 
                foreach($val as $key => $data){
                    echo "{label: '".$data->brand_name."', value: ".$data->total_sales."},";
                }
                ?>
                
            ]
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        
        var chart3 = new Morris.Donut({
            element: 'chart3',
            data: [
                <?php 
                foreach($val2 as $key => $data){
                    echo "{label: '".$data->cate_name."', value: ".$data->total_sales."},";
                }
                ?>
                
            ]
        });
    });
</script>
@endsection