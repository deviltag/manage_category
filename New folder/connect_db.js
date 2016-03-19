function dblookup()
{
    var myConnect = "Provider=Microsoft.Jet.OLEDB.4.0; Data Source=d:\\sdi.mdb"; 
 
    var ConnectObj = new ActiveXObject("ADODB.Connection");
    var RS = new ActiveXObject("ADODB.Recordset");
    var sql="SELECT * FROM employeespulled WHERE empid='1';";
 
    ConnectObj.Open (myConnect);
    RS.Open(sql,ConnectObj,adOpenForwardOnly,adLockReadOnly,adCmdText);
 
    var fieldCount = RS.Fields.Count;
    alert("Field Count" + fieldCount);    
    RS.Close();
    ConnectObj.Close();
}