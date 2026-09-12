var mydate=new Date()
var year=mydate.getYear()
if (year < 1000)
year+=1900
var day=mydate.getDay()
var month=mydate.getMonth()
var daym=mydate.getDate()
if (daym<10)
daym="0"+daym
var dArray=new Array("MINGGU","SENIN","SELASA","RABU","KAMIS","JUM'AT","SABTU")
var mArray=new Array("JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER")
document.write("<font>"+dArray[day]+", "+daym+" "+mArray[month]+" "+year+"</font>")