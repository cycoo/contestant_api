
<div class="container">
    <h2>Rating Graph</h2> 
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto">
    	
    </div>
</div>

  <script src="<?= base_url()?>themes/js/highcharts.js"></script>
  <script src="<?= base_url()?>themes/js/exporting.js"></script>
<script type="text/javascript">
	$(document).ready(function (){
			var x=[];
			var y=[];
		    $.ajax({                                      
		      url: '<?= site_url('Rating/ajax_ratings')?>',              
		      type: "post",          
		      data: {},
		      dataType: 'json',
		      success: function(result){
		      		var contestants=result['contestants'];
		      		var ratings=result['rating']
		      		for (var key in ratings) {
				        y.push(result['rating'][key]);
				        x.push(Number(key));
				    }

				Highcharts.chart('container', {
				    chart: {
				        type: 'column'
				    },
				    title: {
				        text: 'Total Contestant Ratings'
				    },
				    xAxis: {
				        categories:x.map(function(obj){ 
									   return obj;
									}),
				        crosshair: true
				    },
				    yAxis: {
				        min: 0,
				        max:5,
				        title: {
				            text: '<b>Ratings</b>'
				        }
				    },
				    tooltip: {
				    	formatter: function() {
				    		var contestant_name;
				    		for(var key in contestants){
				    			if(contestants[key]['contestant_id']==this.x){
				    				contestant_name=contestants[key]['firstname']+" "+contestants[key]['lastname'];
				    			}
				    		}
				    		
				    		var tt='<span style="font-size:10px"><b>'+contestant_name+'</b></span><table>';
				    			tt+='<tr><td style="color:skyblue;padding:0">Average Rating: </td>';
				    			tt+='<td style="padding:0"><b>'+this.y+'</b></td></tr>';
				    			tt+='</table>'
					        return tt;
					    },
				        // headerFormat: '<span style="font-size:10px">'+this.x+'</span><table>',
				        // pointFormat: '<tr><td style="color:{series.color};padding:0">Average Rating: </td>' +
				        //     '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
				        // footerFormat: '</table>',
				        shared: true,
				        useHTML: true
				    },
				    plotOptions: {
				        column: {
				            pointPadding: 0.2,
				            borderWidth: 0
				        }
				    },
				    series: [{
				        name: '<b>Contestants</b>',
				        data: y.map(function(obj){ 
							   return obj;
							})
				    }]
					});		   
			    }
		});
		    

			
	});
	
</script>

