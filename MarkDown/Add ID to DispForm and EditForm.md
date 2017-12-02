#Add ID to DispForm and EditForm

Add the following snippet into a content editor box on the DispForm.aspx & EditForm.aspx pages to get a read only field with the items ID

>Note: to bring up the editable versions of those forms just add *?ToolPaneView=2* to the URL

```javascript
<script language="javascript" type="text/javascript">
  
_spBodyOnLoadFunctionNames.push("showID");
  
function showID()
{
var querystring = location.search.substring(1, location.search.length);
var ids = querystring.split("&")[0];
var id = ids.split("=")[1];
var Td1 = document.createElement("td");
Td1.className = "ms-formlabel";
Td1.innerHTML ="<h3 class ='ms-standardheader'>ID</h3>";
var Td2 = document.createElement("td");
Td2.className =  "ms-formbody";
Td2.innerHTML = id;
var Tr1 = document.createElement("tr");
Tr1.appendChild(Td1);
Tr1.appendChild(Td2);
var Location = GetSelectedElement(document.getElementById("idAttachmentsRow"),"TABLE").getElementsByTagName("TBODY")[0];
Location.insertBefore(Tr1,Location.firstChild);
}
</script>
```

#Reference
https://social.technet.microsoft.com/wiki/contents/articles/5537.sharepoint-2013-how-to-show-the-id-field-in-editform-aspx-and-dispform-aspx.aspx