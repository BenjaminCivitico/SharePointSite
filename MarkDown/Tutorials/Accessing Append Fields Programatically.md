# Accessing Append Fields Programmatically

From the OOTB Issues Log to your own custom lists, SharePoint has a built in feature that allows you to append changes in a multi-line text field. An append field will allow users to enter new information into a text box, and have a version history of previous entries into that field. This is great for any field that a user might want, where changes need to be tracked for things like auditing.

## Creating an Append Field
Creating an append field is easy, when you add a new field to a list, if you select the "Multiple lines of text" field type, SharePoint will give you the option in the dialogue box to "Append Changes to Existing Text"

![Creating a new append field](./img/markDown/appendField/creation.png "appedFieldCreation")

## Accessing an Append Field Programmatically.
In my experience, unfortunately append fields are handled quite poorly by SharePoint. You are going to run into issues if you attempt to use the CSOM or Rest queries to reliably access their contents. This is because while the field is there in the list, the property may not be present on the list entry when you try to retrieve it. It seems sometimes that SharePoint just doesn't include this property. As such, I have found it far more reliable to use the .NET server object model to retrieving list entries, and then use the list item to access the appended fields.

I call the following code while looping through the list items when I need to access all of the appended content. You will need to tweak the string builder to get the output you desire.

```csharp
/// <summary>
/// This function takes a list item, and a field name, and will return a string of all non empty appended entries, as well as the author, and the time it was added.
/// <param name="item"> The list item that contains a field with appended information</param>
/// <param name="field"> The field with appended data you wish to receive</param>
/// </summary>
public static string GetAppendFieldData(SPListItem item, string field)
{
	StringBuilder sb = new StringBuilder();
	foreach (SPListItemVersion version in item.Web.Lists[item.ParentList.ID].Items[item.UniqueId].Versions)
	{
		SPFieldMultiLineText CommentsField = version.Fields.GetFieldByInternalName(field) as SPFieldMultiLineText;
		if (CommentsField != null)
		{
			string comment = CommentsField.GetFieldValueAsText(version[field]);
			if (comment != null && comment.Trim() != string.Empty)
			{
				sb.Append("");
				sb.Append(version.CreatedBy.User.Name).Append(" (");
				sb.Append(version.Created.ToString("MM/dd/yyyy hh:mm tt"));
				sb.Append(") ");
				sb.Append(comment);
			}
		}
	}
	return sb.ToString();
}
```

## Reference
http://www.reality-tech.com/the-sharepoint-internals-behind-an-append-text-field/

