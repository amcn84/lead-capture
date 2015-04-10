Installation instructions:
	Edit the get_leads.php and add your API key.
	Copy all files to your webserver to a subfolder of your choosing.
	Adjust permissions as necessary.
	The scripts needs to write to 3 files (count.txt, leads.csv, and timer.txt)
	
	On the thank you page of your IDX Broker Lite/Platinum account add the following code snippet
	into the Tracking Code Section.
	
	// Begin Code Snippet //
	<script>
		$.ajax({
			type: "GET",
			url: 'http://www.yourwebsite.com/your-sub-folder/get_leads.php',
		});
	</script>
	// End Code Snippet //
	
About:
	This script will update a csv file with all the leads from an IDX Broker account that you can
	then send on to the CRM of your choice or use yourself to keep a spreadsheet. The script will
	automatically timeout for an hour if the Hourly Access Rate is over 50. That threshhold can be
	adjusted by editing the check.php file.

Disclaimer:
	This code is not official IDX Broker code. It does use their API, but in 
	NO WAY is it supported by IDX Broker. DO NOT contact IDX Broker for any support of this code.
