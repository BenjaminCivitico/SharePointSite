#Using JavaScript to Edit a Form in SharePoint

Sometimes when using forms in Sharepoint you will find that you can't quite do what you want with out of the box functionality. In those cases there is a few options open to make changes to the form, such as desinging a whole new form in asp.net, but for cases where you don't need the power of C# it's easiest to make changes to one of the existing forms using JavaScript.

In this tutorial I'm just going to cover a few things that have helped me out.

##Accessing the Form Edit Toolbar

From any list item you can just add ___?ToolPanelView=2___ to the URL to access that list view with the ribbon menu and the WebPart edit menu.
If there isn't a list item, just add /DispForm.aspx or /EditForm.aspx to the list URL and then add the tool panel view query.

##Adding the JS

Best case is to save your js as a js file in the site assets library. Then you just need to use a content editor WebPart to add your js.

##Adding a Content Editor WebPart to the bottom of a form.

The easiest way to move your content editor WebPart to the botom of the form is through SharePoint Designer 2013.

1. Add a content editor 
1. Browse the the document library or list in SharePoint Designer.
2. Create a new Edit Form in the library's Forms menu. Set this as the default edit form.
3. 
