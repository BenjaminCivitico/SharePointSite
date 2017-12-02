#Using the SCOM

The SharePoint client object model(SCOM) allows you to access list, and site content.

SCOM is a programatic way to access SharePoint Content.

Make sure that you load the web context before anything else.

##Loading a Web With SCOM

1. Start by creating the client context. *I like to contain my client contexts in a using block*

```csharp
using (ClientContext clientCtx = new ClientContext([SiteURL]))
    {
    }
```

2. Load your web context. I'm going to bind mine to the variable web. Then execute the query to have your web context available.

```csharp
Web web = clientCtx.Web;
clientCtx.Load(Web);
clientCtx.ExecuteQuery();
```

3. The code is as follows

```csharp
using (ClientContext clientCtx = new ClientContext([SiteURL]))
    {
	    Web web = clientCtx.Web;
		clientCtx.Load(Web);
		clientCtx.ExecuteQuery();
    }
```

##Loading a List With SCOM

1. Start by creating the client context. *I like to contain my client contexts in a using block*

```csharp
using (ClientContext clientCtx = new ClientContext([SiteURL]))
    {
    }
```

2. Load your webcontext and the lists contained on the site.

```csharp
Web web = clientCtx.Web;
clientCtx.Load(web, w => w.Lists);
clientCtx.ExecuteQuery();
```

3. Load your list, and run a CAML query to retrieve list items. *By using the <View/> CAML query I am retrieving all the list entries*

```csharp
List list = clientCtx.Web.Lists.GetByTitle([ListName]);
CamlQuery query = new CamlQuery();
query.ViewXml = "<View/>";
ListItemCollection items = list.GetItems(query);
clientCtx.Load(list);
clientCtx.Load(items);
clientCtx.ExecuteQuery();
```

4. Loop through the list items and run whatever logic you'd like on the list.

```csharp
foreach (ListItem item in items)
{
}
```

5. The whole code is as follows

```csharp
using (ClientContext clientCtx = new ClientContext([SiteURL]))
	{
		Web web = clientCtx.Web;
		clientCtx.Load(web, w => w.Lists);
		clientCtx.ExecuteQuery();

		List list = clientCtx.Web.Lists.GetByTitle([ListName]);
		CamlQuery query = new CamlQuery();
		query.ViewXml = "<View/>";
		ListItemCollection items = list.GetItems(query);

		clientCtx.Load(list);
		clientCtx.Load(items);
		clientCtx.ExecuteQuery();

		foreach (ListItem item in items)
		{
		}
	}
```

##Notes

- SCOM will queue up queries to the server untill you execute them. This is to save resources. *Make sure that you execute your queries before attempting to use the variables.*