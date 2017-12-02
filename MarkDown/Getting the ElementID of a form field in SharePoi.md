#Getting the ElementID of a form field in SharePoint 2016 using JavaScript

In SharePoint 2016 there's no way to set a static ElementID for elements of an out of the box form. SharePoint does however set the title of an element to the title of the column that field corresponds to. The following code snippet will allow you to get the element based on the title for your own purposes.

```javascript
function getField(fieldID){
	var docTags = document.all;
	for (var i=0; i < docTags.length; i++){
		if (docTags[i].title == fieldID){
			return docTags[i];
		}
	}
}
```