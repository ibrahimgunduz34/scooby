## What is Scooby ?
Scooby is powerfull api testing tool with event handling mechanism. Scooby test the any api with your developed test scripts and trigger some events with evaluating test result. You can do whatever want use with event classes in specified status (criticalLevel, Stable)

## How can i use it ?
First step, you should develop a test script  as following pattern and put to "library/Scooby/Test/" folder.
```php
<?php
class Scooby_Tester_YourProvider_YourTest extends Scooby_Tester_Abstract implements Scooby_Tester_Interface
{
    protected function _invoke(Zend_Config $providerConfig)
    {
        //write some test 
        $result = new Scooby_Tester_Result();

        //if your test performed successfuly :
        $result->setSuccess(true);

        //if your test doesn't perform successfuly :
        $result->setSuccess(false);

        return $result;
    }
}
```
And save this file as "YourTest.php" to "library/Scooby/Tester/YourProvider/" folder.

Scondary, Create your Stable and Critical Error Level event scripts as following:

CriticalLevel Event:
```php
<?php
class Scooby_Event_YourProvider_CriticalLevel implements Scooby_Event_Interface
{
    public function trigger(Scooby_Event $event)
    {

    }
}
```

Stable Event:
```php
<?php
class Scooby_Event_YourProvider_Stable implements Scooby_Event_Interface
{
    public function trigger(Scooby_Event $event)
    {

    }
}
```
And finaly define your test and event classes to your configuration file. (configs/config.xml)
```xml
<?xml version="1.0" encoding="ISO-8859-9"?>
<config>
    <providers>
        <YourProvider>
            <name>Garanti Bankasi</name>
            <parameters>
                <period>10</period>
                <delay>1000</delay>
                <criticalLevel>0.47</criticalLevel>
                <credentials>
                    <url>https://sanalposprovtest.garanti.com.tr/VPServlet</url>
                    <username>rocketInternet</username>
                    <password>rocket123</password>
                </credentials>
            </parameters>
            <testers>
                <tester>YourProvider_YourFile</tester>
            </testers>
            <events>
                <criticalLevel>YourProvider_CriticalLevel</criticalLevel>
                <stable>YourProvider_Stable</stable>
            </events>
        </YourProvider>
    </providers>
</config>
```

Go.. Go.. Go....!
```
php index.php
```
