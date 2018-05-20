#Using JavaScript to Open Attachments in a New Tab

In SharePoint 2016 when you open an attachment from an edit form, the attachment will open in the same window. This will result in the loss of entered form data when users return to the form with the browsers back button. To prevent this, instead change the default behaviour of attachments in the edit form. By adding the following Script to the form, attachments will instead open in a new tab.

>Note: You will need jQuery for this script.

>Note2: To bring up the editable versions of these forms just add *?ToolPaneView=2* to the URL


```javascript
$(document).ready(function(){
        $("table#idAttachmentsTable a").attr('onclick', '').click(function (event) {
            event.preventDefault();
            var url=$(this).attr('href');
            window.open(url, '_blank');
        });
    });
```

#Reference
https://sharepoint.stackexchange.com/questions/179942/open-attachments-in-new-tab-issue?utm_medium=organic&utm_source=google_rich_qa&utm_campaign=google_rich_qa