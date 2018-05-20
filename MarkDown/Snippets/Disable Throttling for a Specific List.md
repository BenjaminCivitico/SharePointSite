#Disable Throttling for a Specific List in SharePoint 2016

__Note: This should only be used as a last resort. Explore indexing, and reducing list sizes by other means before resorting to disabling throttling.___

If you find that a list is exceeding the list view threshold, but you need to still access the list and indexing and reorganizing data options have been exhausted then use the following inside of a SharePoint Management Shell console to exclude a list from throttling.

```powershell
$Site  =  Get-SPWeb -Identity <SiteURL>
$List  =  $Site.Lists[“List Name”]
$List.EnableThrottling =  $false
$List.Update()
```

#Reference
https://sharepointumar.wordpress.com/2014/03/15/disable-throttling-for-a-single-list/