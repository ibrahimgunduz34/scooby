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
##Licence

Copyright (C) 2012 İbrahim Gündüz

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

