# Sharepoint Timer Jobs

A SharePoint timer job is a scheduled process run by the SharePoint timer Service. They should be used sparingly, and only when built in functionality cannot be relied upon.

## Creation Steps

1. Create a new SharePoint 2016 - Empty Project. Call this project something contextual, like CompanyName.TimerJob.Report *Farm Solution*.
2. Right click the project and add a new class. This will be the class that runs the logic for the timer job. Call this class Timer.
3. Make your class a super class of Microsoft.SharePoint.Administration.SPJobDefinition.

> If you get the following error "The type or namespace 'SPJobDefinition' does not exist in the namespace 'Microsoft.SharePoint.Administration' (are you missing an assembly reference?)". Double check that your solution is set to be a Farm Solution as a Sandboxed Solution will not have access to this class.

4. Add the three default constructors of SPJobDefinition to your class

```csharp
string timerJobName = "name";
public Timer() : base() { }
public Timer(string jobName, SPService service, SPServer server, SPJobLockType targetType) : base(jobName, service, server, targetType) { }
public Timer(string jobName, SPWebApplication webApplication) : base(jobName, webApplication, null, SPJobLockType.ContentDatabase)
{
    this.Title = timerJobName;
}
```

5. Add an override for the Execute() Method

> You will write the code that needs to run for the timer job inside of this method.

6. Add a feature to activate your timer job. Scope the feature to the *Site* scope.
7. Right click your feature, and add an event reciever.
8. Inside of the event reciever class define the name for your timer job as a constant string. *I call this variable jobName*
9. In the Event Reciever, uncomment the FeatureActivated, and FeatureDeactivated methods.
10. Add a new method called DeleteJob, and parse in the SPFeatureReceiverProperties properties.

```csharp
private void DeleteJob(SPFeatureReceiverProperties properties)
	{
		SPSecurity.RunWithElevatedPrivileges(delegate () {
			SPSite site = properties.Feature.Parent as SPSite;

			// delete the job   
			site.WebApplication.JobDefinitions.Where(t => t.Name.Equals(jobName)).ToList().ForEach(j => j.Delete());
		});
	}
```

11. Add the following code to the FeatureActivated function.

```csharp
public override void FeatureActivated(SPFeatureReceiverProperties properties)
	{
		DeleteJob(properties);
		SPSecurity.RunWithElevatedPrivileges(delegate () {

			SPSite site = properties.Feature.Parent as SPSite;

			// install the job   
			TimerJobClass listLoggerJob = new TimerJobClass(List_JOB_NAME, site.WebApplication);
			SPMinuteSchedule schedule = new SPMinuteSchedule();
			schedule.BeginSecond = 0;
			schedule.EndSecond = 59;
			schedule.Interval = 15;
			listLoggerJob.Schedule = schedule;
			listLoggerJob.Update();
		});
	}
```

12. Add the DeleteJob function to the FeatureDeactivation function.

```csharp
public override void FeatureDeactivating(SPFeatureReceiverProperties properties)
	{
		DeleteJob(properties);
	}
```

13. Deploy the timer job. It will run every 15 minutes in the current configuration. You should change the time inside of central admin.

## Notes:

- Timer job features should be site scoped.

## Troubleshooting

While using SharePoint timer jobs I have encounted a few errors of my own.

-----

___I have updated and deployed a SharePoint timer job using Visual Studio, and when I run the job it appears to be running an older version of the job?___

This happens from time to time. To fix this error, restart the SharePoint timer service from the servers services menu. This should fix the issue.

-----

## Deployment Commands:

- **Be Warned**, When you run the Install-SPSolution IIS will restart

```powershell
Add-SPSolution “[Solution Address]”
Install-SPSolution –Identity “[Solution Name]” –GacInstall – Force
$featureName = “[Feature Name]”
Install-SPFeature $featureName –Force
Enable-SPFeature –Identity $featureName –URL [Site Collection URL] -PassThru
```
