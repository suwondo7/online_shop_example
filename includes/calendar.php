<center>
<script language="javascript">
	<!-- Begin
	monthnames = new Array(
	"Januari",
	"Februari",
	"Maret",
	"April",
	"Mei",
	"Juni",
	"Juli",
	"Agustus",
	"September",
	"Oktober",
	"Nopember",
	"Desember");
	var linkcount=0;
	function addlink(month, day, href) {
	var entry = new Array(3);
	entry[0] = month;
	entry[1] = day;
	entry[2] = href;
	this[linkcount++] = entry;
	}
	Array.prototype.addlink = addlink;
	linkdays = new Array();
	monthdays = new Array(12);
	monthdays[0]=31;
	monthdays[1]=28;
	monthdays[2]=31;
	monthdays[3]=30;
	monthdays[4]=31;
	monthdays[5]=30;
	monthdays[6]=31;
	monthdays[7]=31;
	monthdays[8]=30;
	monthdays[9]=31;
	monthdays[10]=30;
	monthdays[11]=31;

	todayDate=new Date();

	thisday=todayDate.getDay();
	thismonth=todayDate.getMonth();
	thisdate=todayDate.getDate();
	thisyear=todayDate.getYear();
	thisyear = thisyear % 100;
	thisyear = ((thisyear < 50) ? (2000 + thisyear) : (1900 + thisyear));
	if (((thisyear % 4 == 0) 
	&& !(thisyear % 100 == 0))
	||(thisyear % 400 == 0)) monthdays[1]++;
	startspaces=thisdate;
	while (startspaces > 7) startspaces-=7;
	startspaces = thisday - startspaces + 1;
	if (startspaces < 0) startspaces+=7;
	document.write("<table border=0 cellspacing=0 cellpadding=0 ");
	document.write("bordercolor=#666666 width=100%><font color=black>");
	document.write("<tr><td colspan='7' bgcolor='#ccc' style='border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px;'><center><strong><font size=2 face=arial>" 
	+ monthnames[thismonth] + " " + thisyear 
	+ "</font></strong></center></font></td></tr>");
	document.write("<tr>");
	document.write("<td align=center><font size=1 color=red>M</font></td>");
	document.write("<td align=center><font size=1>S</font></td>");
	document.write("<td align=center><font size=1>S</font></td>");
	document.write("<td align=center><font size=1>R</font></td>");
	document.write("<td align=center><font size=1>K</font></td>");
	document.write("<td align=center><font size=1 color=green>J</font></td>");
	document.write("<td align=center><font size=1>S</font></td>"); 
	document.write("</tr>");
	document.write("<tr>");
	for (s=0;s<startspaces;s++) {
	document.write("<td> </td>");
	}
	count=1;
	while (count <= monthdays[thismonth]) {
		for (b = startspaces;b<7;b++) {
			linktrue=false;
			document.write("<td align=center><font size=1>");
			for (c=0;c<linkdays.length;c++) {
				if (linkdays[c] != null) {
					if ((linkdays[c][0]==thismonth + 1) && (linkdays[c][1]==count)) {
						document.write("<a href=\"" + linkdays[c][2] + "\">");
						linktrue=true;
						}
					}
				}
			if (count <= monthdays[thismonth]) {
				if (b==0) {
					document.write("<font color=red>");}
				if (b==5) {
					document.write("<font color=green>");}
				if (count==thisdate) {
					document.write("<font size=2 color=blue><strong>");}
				
				document.write(count);

				if (count==thisdate) {
					document.write("</strong></font>");}			
				if (b==0){
					document.write("</font>");}
				if (b==5){
					document.write("</font>");}

				}
			else {
			document.write(" ");
				}
			if (linktrue)
				document.write("</a>");
			document.write("</font></td>");
			count++;
			}
		document.write("</tr>");
		document.write("<tr>");
		startspaces=0;
	}
	document.write("</table>");
	// End -->
</script>
</center>