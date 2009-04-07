<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/code/_resources/main.php' ?>
<?

$file = 'grid.csv';
$handle = fopen($file, "r");
while (($rows[] = fgetcsv($handle, 1000, ",")) !== FALSE);
array_pop($rows);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>David Singleton &raquo; Code</title>
	<link rel="stylesheet" href="/code/_static/css/text.css" type="text/css" />
	<link rel="stylesheet" href="/code/_static/css/structure.css" type="text/css" />
	<link rel="stylesheet" href="/code/_static/css/tables.css" type="text/css" />
	<style type="text/css" media="screen">
		table th,
		table td {
			padding: 4px;
			text-align: right;
			border-bottom: 1px solid #ccc;
			border-right: 1px dashed #ddd;
		}
		
		tr.alt td {
			background: #fff;
		}
		
		tr td.alt {
			background: #fff;
		}
		
		tr.alt td.alt {
			background: #ff;
		}
		
	</style>
	<script type="text/javascript" src="/code/_static/js/jquery.js"></script>
	<script type="text/javascript" charset="utf-8">
		$().ready(function(){
			$('table tr:nth-child(even)').addClass('alt');
			$('table tr td:nth-child(even)').addClass('alt');
		})
	</script>
 </head>

  <body class="l-3col">
	
	<h1>Housing Stuff</h1>
	
	<div class="primary content">
		<h2>Links</h2>
		
		<h3>Properties</h3>
		
		<h3>Agents/Searchs</h3>
		
		<h3>Misc</h3>
	</div>
	
	<div class="secondary content">
		<h2>Prices</h2>
		<table width="100%">
			<thead>
				<tr>
					<th>Per Week</th>
					<th>Per Month</th>
					<th>2 Bed</th>
					<th>3 Bed</th>
					<th>4 Bed</th>
				</tr>
			</thead>

			<tbody>
				<?php foreach($rows as $row) { ?>
					<tr>
						<td><?php h($row['0']) ?></td>
						<td><?php h($row['1']) ?></td>
						<td><?php h($row['2']) ?></td>
						<td><?php h($row['3']) ?></td>
						<td><?php h($row['4']) ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>

	</div>
	
	<div class="secondary content">
		<h2>Notes</h2>
		
		<h3>People</h3>
		<p>Everyone has contact details and such on these.</p>
		<ul>
			<li><a href="http://dsingleton.co.uk">David Singleton</a></li>
			<li><a href="http://adkent.com">Andy Kent</a></li>
			<li><a href="http://ben-ward.co.uk">Ben Ward</a></li>
			<li><a href="http://carlgaywood.co.uk">Carl Gaywood</a></li>
			
		</ul>
	</div>
	
	<a href="/code/" id="morelink">More Code</a>
	
  </body>
</html>
