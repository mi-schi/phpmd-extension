# phpmd-symfony2

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE.md)
[![Build Status](https://travis-ci.org/mi-schi/phpmd-symfony2.svg?branch=master)](https://travis-ci.org/mi-schi/phpmd-symfony2)
[![Build Status](https://scrutinizer-ci.com/g/mi-schi/phpmd-symfony2/badges/build.png?b=master)](https://scrutinizer-ci.com/g/mi-schi/phpmd-symfony2/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/mi-schi/phpmd-symfony2/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mi-schi/phpmd-symfony2/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mi-schi/phpmd-symfony2/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mi-schi/phpmd-symfony2/?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/556054ac634daa30fb00115d/badge.svg?style=flat)](https://www.versioneye.com/user/projects/556054ac634daa30fb00115d)
[![Latest Stable Version](https://poser.pugx.org/mi-schi/phpmd-symfony2/v/stable)](https://packagist.org/packages/mi-schi/phpmd-symfony2)
[![Total Downloads](https://poser.pugx.org/mi-schi/phpmd-symfony2/downloads)](https://packagist.org/packages/mi-schi/phpmd-symfony2)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/892d02a2-5e5e-4b4e-b2d3-ee086edfbd78/small.png)](https://insight.sensiolabs.com/projects/892d02a2-5e5e-4b4e-b2d3-ee086edfbd78)

## Features

Extends phpmd with rules for Symfony2. Also add extra rules from clean code.

* Clean Code
    * [ClassNameSingleResponsibility](https://github.com/mi-schi/phpmd-symfony2/blob/master/Rulesets/cleancode.xml#L15-L18)
    * [MethodOneTryCatch](https://github.com/mi-schi/phpmd-symfony2/blob/master/Rulesets/cleancode.xml#L47)
* Symfony2
    * [ControllerMethodName](https://github.com/mi-schi/phpmd-symfony2/blob/master/Rulesets/symfony2.xml#L14-L16)
    * [EntitySimpleGetterSetter](https://github.com/mi-schi/phpmd-symfony2/blob/master/Rulesets/symfony2.xml#L41-L43)
* Tests
    * [MethodNumberOfMocks](https://github.com/mi-schi/phpmd-symfony2/blob/master/Rulesets/test.xml#L14-L17)
    * [MethodNumberOfAsserts](https://github.com/mi-schi/phpmd-symfony2/blob/master/Rulesets/test.xml#L56-L58)

## Installation

Use ```composer``` for installation by adding the following to your ```composer.json``` file:

```
"require-dev": {
    "mi-schi/phpmd-symfony2": "dev-master"
}
```

## Usage

Create a phpmd.xml file and import the basic rules from phpmd. The example below contains useful changes.
Then you can extend this configuration with the rules from this repository.

### Basic Rules

```xml
<ruleset name="basic-rules"
         xmlns="http://pmd.sf.net/ruleset/1.0.0"
         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:schemaLocation="http://pmd.sf.net/ruleset/1.0.0
                      http://pmd.sf.net/ruleset_xml_schema.xsd"
         xsi:noNamespaceSchemaLocation="http://pmd.sf.net/ruleset_xml_schema.xsd">
    <description>mess detection</description>

    <rule ref="rulesets/cleancode.xml" />
    <rule ref="rulesets/codesize.xml">
        <exclude name="ExcessiveParameterList" />
        <exclude name="ExcessiveMethodLength" />
        <exclude name="ExcessiveClassLength" />
    </rule>
    <rule ref="rulesets/codesize.xml/ExcessiveParameterList">
        <priority>3</priority>
        <properties>
            <property name="minimum" value="4" />
        </properties>
    </rule>
    <rule ref="rulesets/codesize.xml/ExcessiveMethodLength">
        <priority>3</priority>
        <properties>
            <property name="minimum" value="31" />
            <property name="ignore-whitespace" value="true" />
        </properties>
    </rule>
    <rule ref="rulesets/codesize.xml/ExcessiveClassLength">
        <priority>3</priority>
        <properties>
            <property name="minimum" value="301" />
            <property name="ignore-whitespace" value="true" />
        </properties>
    </rule>
    <rule ref="rulesets/controversial.xml" />
    <rule ref="rulesets/design.xml" />
    <rule ref="rulesets/naming.xml">
        <exclude name="ShortVariable" />
        <exclude name="LongVariable" />
    </rule>
    <rule ref="rulesets/naming.xml/ShortVariable">
        <priority>3</priority>
        <properties>
            <property name="minimum" value="2" />
        </properties>
    </rule>
    <rule ref="rulesets/naming.xml/LongVariable">
        <priority>3</priority>
        <properties>
            <property name="maximum" value="30" />
        </properties>
    </rule>
    <rule ref="rulesets/unusedcode.xml" />
</ruleset>
```

### Add extra rules

```xml
    <rule ref="../../../../../mi-schi/phpmd-symfony2/Rulesets/cleancode.xml" />
    <rule ref="../../../../../mi-schi/phpmd-symfony2/Rulesets/symfony2.xml" />
    <rule ref="../../../../../mi-schi/phpmd-symfony2/Rulesets/test.xml" />
```

You can also adapt the rules with properties or use only special rules. Take a look in the xmls. It works like the basic ruleset logic.

## ToDos

- [ ] Rule against Train Wreck (getFoo()->getBar()->getMuh()->getMeh())
- [x] testCanAddTwoNumbers is better than testAdd
- [ ] Rule for high cohesion (member variables are used by a lot of methods)
- [ ] Rule against inline ifs (? '' : '')
- [ ] Rule that a service should never call a controller
- [ ] Rule against useless comments (same name as method name)
- [ ] Try to avoid "return $this->doSomething() && !$this->doOtherthings()"
