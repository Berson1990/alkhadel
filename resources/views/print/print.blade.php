
<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">

		<title>TableTools</title>
		
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
		
		<link rel="stylesheet" type="text/css" href="/media/css/site.css?_=97e72e3a278f58adfb977da843af7680">
		<link rel="stylesheet" type="text/css" href="/release-datatables/extensions/TableTools/css/dataTables.tableTools.css">
		<style type="text/css">
			
		</style>

		<script type="text/javascript" src="/media/js/site.js?_=207805c784725de7bada944126dbaa67"></script>
		<script type="text/javascript" src="/media/js/dynamic.php" async></script>
		<script type="text/javascript" language="javascript" src="/release-datatables/extensions/TableTools/js/dataTables.tableTools.js"></script>
		<script type="text/javascript">
			

$(document).ready( function () {
    $('#example').dataTable( {
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "/release-datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
        }
    } );
} );


		</script>
	</head>
	<body class="wide">

		<a name="top"></a>
		<div class="fw-container">
			<div class="fw-header">
				<img src="/media/images/logo-fade.png" class="logo" />

				<div class="nav-master">
					<ul>
						<li class="active"><a href="/">DataTables</a></li>
						<li><a href="//editor.datatables.net">Editor</a></li>
					</ul>

					<div class="account"></div>
				</div>

				<div class="toolbar">
					<div class="toolbar_search">
						<form action="/search" id="cse-search-box">
							<input type="hidden" name="cx" value="004673356914326163298:bcgejkcchl4" />
							<input type="hidden" name="cof" value="FORID:9" />
							<input type="hidden" name="ie" value="UTF-8" />
							<input type="text" name="q" size="31" />
							<input type="submit" name="sa" value="Search" class="btn" />
						</form>
					</div>
				</div>

				<div id="ad"></div>
			</div>

			<div class="fw-nav">
				<div class="nav-main">
					<ul><li class=" sub"><a href="/examples/index">Examples</a></li><li class=" sub"><a href="/manual/index">Manual</a></li><li class=" sub"><a href="/reference/index">Reference</a></li><li class="sub-active sub"><a href="/extensions/index">Extensions</a><ul><li class=" sub"><a href="/extensions/autofill">AutoFill</a></li><li class=" sub"><a href="/extensions/colreorder">ColReorder</a></li><li class=" sub"><a href="/extensions/colvis">ColVis</a></li><li class=""><a href="/extensions/editor">Editor</a></li><li class=" sub"><a href="/extensions/fixedcolumns">FixedColumns</a></li><li class=" sub"><a href="/extensions/fixedheader">FixedHeader</a></li><li class=" sub"><a href="/extensions/keytable">KeyTable</a></li><li class=" sub"><a href="/extensions/responsive">Responsive</a></li><li class=" sub"><a href="/extensions/scroller">Scroller</a></li><li class="active sub"><a href="/extensions/tabletools">TableTools</a><ul><li class=""><a href="/extensions/tabletools/api">API</a></li><li class=""><a href="/extensions/tabletools/initialisation">Initialisation</a></li><li class=""><a href="/extensions/tabletools/button_options">Button options</a></li><li class=""><a href="/extensions/tabletools/examples">Examples</a></li><li class=""><a href="/extensions/tabletools/buttons">Buttons</a></li><li class=""><a href="/extensions/tabletools/plug-ins">Plug-ins</a></li></ul></li></ul></li><li class=" sub"><a href="/plug-ins/index">Plug-ins</a></li><li class=""><a href="/blog/index">Blog</a></li><li class=""><a href="/forums/index">Forums</a></li><li class=""><a href="/support/index">Support</a></li><li class=""><a href="/faqs/index">FAQs</a></li><li class=""><a href="/download/index">Download</a></li><li class=""><a href="/purchase/index">Purchase</a></li></ul>
				</div>

				<div class="mobile-show">
					<a><i>Show site navigation</i></a>
				</div>
			</div>

			<div class="fw-body">
				<div class="content">
					
					<h1 class="page_title">TableTools</h1>

					<div class="grid"><div class="unit w-1-2"><p>TableTools is a plug-in for the DataTables HTML table enhancer, which adds a highly customisable button toolbar to a DataTable. Key features include:</p>

<ul class="markdown">
<li>Copy to clipboard</li>
<li>Save table data as CSV, XLS or PDF files</li>
<li>Print view for clean printing</li>
<li>Row selection options</li>
<li>Easy use predefined buttons</li>
<li>Simple customisation of buttons</li>
<li>Well defined API for advanced control</li>
</ul></div>

<div class="unit w-1-2"><p>Keen to dive right in? Initialising TableTools with DataTables:</p>

<pre><code class="multiline language-js">/*
 * Example initialisation
 */
$(document).ready( function () {
    $('#example').dataTable( {
        "dom": 'T&lt;"clear"&gt;lfrtip',
        "tableTools": {
            "sSwfPath": "/swf/copy_csv_xls_pdf.swf"
        }
    } );
} );
</code></pre></div></div>

<a name="Example"></a><h2 data-anchor="Example">Example</h2>

<p><table id="example" class="display" cellspacing="0" width="100%"><thead><tr><th>Name</th><th>Position</th><th>Office</th><th>Age</th><th>Start date</th><th>Salary</th></tr></thead><tfoot><tr><th>Name</th><th>Position</th><th>Office</th><th>Age</th><th>Start date</th><th>Salary</th></tr></tfoot><tbody><tr><td>Tiger Nixon</td><td>System Architect</td><td>Edinburgh</td><td>61</td><td>2011/04/25</td><td>$320,800</td></tr><tr><td>Garrett Winters</td><td>Accountant</td><td>Tokyo</td><td>63</td><td>2011/07/25</td><td>$170,750</td></tr><tr><td>Ashton Cox</td><td>Junior Technical Author</td><td>San Francisco</td><td>66</td><td>2009/01/12</td><td>$86,000</td></tr><tr><td>Cedric Kelly</td><td>Senior Javascript Developer</td><td>Edinburgh</td><td>22</td><td>2012/03/29</td><td>$433,060</td></tr><tr><td>Airi Satou</td><td>Accountant</td><td>Tokyo</td><td>33</td><td>2008/11/28</td><td>$162,700</td></tr><tr><td>Brielle Williamson</td><td>Integration Specialist</td><td>New York</td><td>61</td><td>2012/12/02</td><td>$372,000</td></tr><tr><td>Herrod Chandler</td><td>Sales Assistant</td><td>San Francisco</td><td>59</td><td>2012/08/06</td><td>$137,500</td></tr><tr><td>Rhona Davidson</td><td>Integration Specialist</td><td>Tokyo</td><td>55</td><td>2010/10/14</td><td>$327,900</td></tr><tr><td>Colleen Hurst</td><td>Javascript Developer</td><td>San Francisco</td><td>39</td><td>2009/09/15</td><td>$205,500</td></tr><tr><td>Sonya Frost</td><td>Software Engineer</td><td>Edinburgh</td><td>23</td><td>2008/12/13</td><td>$103,600</td></tr><tr><td>Jena Gaines</td><td>Office Manager</td><td>London</td><td>30</td><td>2008/12/19</td><td>$90,560</td></tr><tr><td>Quinn Flynn</td><td>Support Lead</td><td>Edinburgh</td><td>22</td><td>2013/03/03</td><td>$342,000</td></tr><tr><td>Charde Marshall</td><td>Regional Director</td><td>San Francisco</td><td>36</td><td>2008/10/16</td><td>$470,600</td></tr><tr><td>Haley Kennedy</td><td>Senior Marketing Designer</td><td>London</td><td>43</td><td>2012/12/18</td><td>$313,500</td></tr><tr><td>Tatyana Fitzpatrick</td><td>Regional Director</td><td>London</td><td>19</td><td>2010/03/17</td><td>$385,750</td></tr><tr><td>Michael Silva</td><td>Marketing Designer</td><td>London</td><td>66</td><td>2012/11/27</td><td>$198,500</td></tr><tr><td>Paul Byrd</td><td>Chief Financial Officer (CFO)</td><td>New York</td><td>64</td><td>2010/06/09</td><td>$725,000</td></tr><tr><td>Gloria Little</td><td>Systems Administrator</td><td>New York</td><td>59</td><td>2009/04/10</td><td>$237,500</td></tr><tr><td>Bradley Greer</td><td>Software Engineer</td><td>London</td><td>41</td><td>2012/10/13</td><td>$132,000</td></tr><tr><td>Dai Rios</td><td>Personnel Lead</td><td>Edinburgh</td><td>35</td><td>2012/09/26</td><td>$217,500</td></tr><tr><td>Jenette Caldwell</td><td>Development Lead</td><td>New York</td><td>30</td><td>2011/09/03</td><td>$345,000</td></tr><tr><td>Yuri Berry</td><td>Chief Marketing Officer (CMO)</td><td>New York</td><td>40</td><td>2009/06/25</td><td>$675,000</td></tr><tr><td>Caesar Vance</td><td>Pre-Sales Support</td><td>New York</td><td>21</td><td>2011/12/12</td><td>$106,450</td></tr><tr><td>Doris Wilder</td><td>Sales Assistant</td><td>Sidney</td><td>23</td><td>2010/09/20</td><td>$85,600</td></tr><tr><td>Angelica Ramos</td><td>Chief Executive Officer (CEO)</td><td>London</td><td>47</td><td>2009/10/09</td><td>$1,200,000</td></tr><tr><td>Gavin Joyce</td><td>Developer</td><td>Edinburgh</td><td>42</td><td>2010/12/22</td><td>$92,575</td></tr><tr><td>Jennifer Chang</td><td>Regional Director</td><td>Singapore</td><td>28</td><td>2010/11/14</td><td>$357,650</td></tr><tr><td>Brenden Wagner</td><td>Software Engineer</td><td>San Francisco</td><td>28</td><td>2011/06/07</td><td>$206,850</td></tr><tr><td>Fiona Green</td><td>Chief Operating Officer (COO)</td><td>San Francisco</td><td>48</td><td>2010/03/11</td><td>$850,000</td></tr><tr><td>Shou Itou</td><td>Regional Marketing</td><td>Tokyo</td><td>20</td><td>2011/08/14</td><td>$163,000</td></tr><tr><td>Michelle House</td><td>Integration Specialist</td><td>Sidney</td><td>37</td><td>2011/06/02</td><td>$95,400</td></tr><tr><td>Suki Burks</td><td>Developer</td><td>London</td><td>53</td><td>2009/10/22</td><td>$114,500</td></tr><tr><td>Prescott Bartlett</td><td>Technical Author</td><td>London</td><td>27</td><td>2011/05/07</td><td>$145,000</td></tr><tr><td>Gavin Cortez</td><td>Team Leader</td><td>San Francisco</td><td>22</td><td>2008/10/26</td><td>$235,500</td></tr><tr><td>Martena Mccray</td><td>Post-Sales support</td><td>Edinburgh</td><td>46</td><td>2011/03/09</td><td>$324,050</td></tr><tr><td>Unity Butler</td><td>Marketing Designer</td><td>San Francisco</td><td>47</td><td>2009/12/09</td><td>$85,675</td></tr><tr><td>Howard Hatfield</td><td>Office Manager</td><td>San Francisco</td><td>51</td><td>2008/12/16</td><td>$164,500</td></tr><tr><td>Hope Fuentes</td><td>Secretary</td><td>San Francisco</td><td>41</td><td>2010/02/12</td><td>$109,850</td></tr><tr><td>Vivian Harrell</td><td>Financial Controller</td><td>San Francisco</td><td>62</td><td>2009/02/14</td><td>$452,500</td></tr><tr><td>Timothy Mooney</td><td>Office Manager</td><td>London</td><td>37</td><td>2008/12/11</td><td>$136,200</td></tr><tr><td>Jackson Bradshaw</td><td>Director</td><td>New York</td><td>65</td><td>2008/09/26</td><td>$645,750</td></tr><tr><td>Olivia Liang</td><td>Support Engineer</td><td>Singapore</td><td>64</td><td>2011/02/03</td><td>$234,500</td></tr><tr><td>Bruno Nash</td><td>Software Engineer</td><td>London</td><td>38</td><td>2011/05/03</td><td>$163,500</td></tr><tr><td>Sakura Yamamoto</td><td>Support Engineer</td><td>Tokyo</td><td>37</td><td>2009/08/19</td><td>$139,575</td></tr><tr><td>Thor Walton</td><td>Developer</td><td>New York</td><td>61</td><td>2013/08/11</td><td>$98,540</td></tr><tr><td>Finn Camacho</td><td>Support Engineer</td><td>San Francisco</td><td>47</td><td>2009/07/07</td><td>$87,500</td></tr><tr><td>Serge Baldwin</td><td>Data Coordinator</td><td>Singapore</td><td>64</td><td>2012/04/09</td><td>$138,575</td></tr><tr><td>Zenaida Frank</td><td>Software Engineer</td><td>New York</td><td>63</td><td>2010/01/04</td><td>$125,250</td></tr><tr><td>Zorita Serrano</td><td>Software Engineer</td><td>San Francisco</td><td>56</td><td>2012/06/01</td><td>$115,000</td></tr><tr><td>Jennifer Acosta</td><td>Junior Javascript Developer</td><td>Edinburgh</td><td>43</td><td>2013/02/01</td><td>$75,650</td></tr><tr><td>Cara Stevens</td><td>Sales Assistant</td><td>New York</td><td>46</td><td>2011/12/06</td><td>$145,600</td></tr><tr><td>Hermione Butler</td><td>Regional Director</td><td>London</td><td>47</td><td>2011/03/21</td><td>$356,250</td></tr><tr><td>Lael Greer</td><td>Systems Administrator</td><td>London</td><td>21</td><td>2009/02/27</td><td>$103,500</td></tr><tr><td>Jonas Alexander</td><td>Developer</td><td>San Francisco</td><td>30</td><td>2010/07/14</td><td>$86,500</td></tr><tr><td>Shad Decker</td><td>Regional Director</td><td>Edinburgh</td><td>51</td><td>2008/11/13</td><td>$183,000</td></tr><tr><td>Michael Bruce</td><td>Javascript Developer</td><td>Singapore</td><td>29</td><td>2011/06/27</td><td>$183,000</td></tr><tr><td>Donna Snider</td><td>Customer Support</td><td>New York</td><td>27</td><td>2011/01/25</td><td>$112,000</td></tr></tbody></table></p>

				</div>
			</div>

			<div class="fw-page-nav">
				<div class="page-nav">
					<div class="page-nav-title">Page navigation</div>
				</div>
			</div>

			<div class="fw-footer">
				<div class="copyright">
					DataTables designed and created by <a href="//sprymedia.co.uk">SpryMedia Ltd</a> &copy; 2007-2015. <a href="/license/mit">MIT licensed</a>. Our <a href="/supporters">Supporters</a><br>
					SpryMedia Ltd is registered in Scotland, company no. SC456502.
				</div>
			</div>
		</div>

		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-365466-5']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>
	</body>
</html>