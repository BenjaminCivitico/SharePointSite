#Adding a Site Column that references a column in another subsite.

##How can I add a lookup column to a list from another subsite?

Sometimes in SharePoint you will find that you want to add a lookup column to a list or form that needs to reference a column in another subsite. To do this you'll need to create a site column using some powershell. This site column will be a lookup that points to a column in another subsite. 

```powershell
Add-PSSnapin Microsoft.SharePoint.PowerShell -ErrorAction SilentlyContinue 
 
#Where the Source List for Lookup Exists
$ParentWebURL=[URL of Reference Site]
$ParentListName=[Reference List Name]
$ParentLookupColumnName=[Column for Lookup]
 
#Where the Lookup Site column Going to get created
$ChildWebURL=[Target Site URL]
$ChildLookupColumnName=[Site Column Name]
  
#Get the Parent and Child Webs and List
$ParentWeb = Get-SPWeb $ParentWebURL
$ParentList = $ParentWeb.Lists[$ParentListName]
$ChildWeb = Get-SPWeb $ChildWebURL
 
#Check if Field exists already
if(!$ChildWeb.Fields.ContainsField($ChildLookupColumnName))
{
    #Add Lookup Field
    $ChildLookupColumn = $ChildWeb.Fields.AddLookup($ChildLookupColumnName,$ParentList.id,$False)
    $ChildLookupColumn = $ChildWeb.Fields[$ChildLookupColumnName]
  
    #Setup lookup Field property
    $ChildLookupColumn.LookupWebId = $ParentWeb.ID
    $ChildLookupColumn.LookupField = $ParentList.Fields[$ParentLookupColumnName].InternalName
    #$ChildLookupColumn.AllowMultipleValues=$true
    $ChildLookupColumn.update()
    write-host "Lookup field added successfully!" -f green
}
else
{
    write-host "Field Exists already!" -f red
}
```

##Reference
http://www.sharepointdiary.com/2015/12/create-lookup-site-column-from-subsite-list-using-powershell.html