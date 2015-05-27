// JavaScript Document
var feedcontainer=document.getElementById("feeddiv");
var feedurl="http://news.ppsr.gov.au/feed/";
var feedlimit=2;
var rssoutput="<h2>PPSR News and Promotions</h2>";
function rssfeedsetup(){
var feedpointer=new google.feeds.Feed(feedurl); //Google Feed API method
feedpointer.setNumEntries(feedlimit); //Google Feed API method
feedpointer.load(displayfeed); //Google Feed API method
}
function displayfeed(result){
    var thefeeds=result.feed.entries;
    for (var i=0; i<thefeeds.length; i++){
        var mstring=['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var dstring=['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        var entrydate=new Date(thefeeds[i].publishedDate); //get date of entry
        var entrydatestr=' '+dstring[entrydate.getDay()-1]+", "+entrydate.getDate()+" "+mstring[entrydate.getMonth()]+" "+entrydate.getFullYear();
        rssoutput+="<h3><a href='" + thefeeds[i].link + "'>" + thefeeds[i].title + "</a> <span style='font-size:.6em;color:#454B56;'> | " +entrydatestr+ "</span></h3><p>" + thefeeds[i].content + "</p>";
        }
    feedcontainer.innerHTML=rssoutput;
    }