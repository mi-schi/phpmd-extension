# phpmd-extension

[![GitHub license](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://raw.githubusercontent.com/mi-schi/phpmd-extension/master/LICENSE)
[![Build Status](https://scrutinizer-ci.com/g/mi-schi/phpmd-extension/badges/build.png?b=master)](https://scrutinizer-ci.com/g/mi-schi/phpmd-extension/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/mi-schi/phpmd-extension/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mi-schi/phpmd-extension/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mi-schi/phpmd-extension/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mi-schi/phpmd-extension/?branch=master)
[![Github All Releases](https://img.shields.io/github/downloads/mi-schi/phpmd-extension/total.svg?maxAge=2592000)](https://github.com/mi-schi/phpmd-extension)

## Features

Contains extra phpmd rules from clean code book and the best practices of my experiences.

* CleanCode
    * [DataStructureConstants](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/cleancode.xml#L14-L16)
    * [DataStructureMethods](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/cleancode.xml#L50-L52)
* Design
    * [ConditionalExpression](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/design.xml#L14-L15)
    * [ConstructorNewOperator](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/design.xml#L37-L40)
    * [SwitchStatement](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/design.xml#L78-L82)
    * [TraitPublicMethod](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/design.xml#L134-L137)
    * [TryStatement](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/design.xml#L170)
    * [ReturnStatement](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/design.xml#L220-L221)
* Naming
    * [ClassNameSuffix](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/naming.xml#L15-L18)
    * [CommentDescription](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/naming.xml#L47-L50)
    * [ControllerMethodName](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/naming.xml#L107-L109)
    * [MethodName](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/naming.xml#L138-L140)
* Test
    * [NumberOfMocks](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/test.xml#L14-L17)
    * [NumberOfAsserts](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/test.xml#L56-L58)
    * [MethodName](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/test.xml#L98-L99)
    
## Installation

Download the `phpmd-extension.phar`:

    $ curl -OsL https://github.com/mi-schi/phpmd-extension/releases/download/stable/phpmd-extension.phar
    
Alternatively you can use [tooly-composer-script](https://github.com/tommy-muehle/tooly-composer-script) for installation.

## Usage

1. Create a `phpmd.xml` file and import the basic rules from phpmd. The example below contains some useful changes. Afterwards you can extend the configuration with rules from this repository.
2. Then execute the mess detection with `phpmd-extension.phar [path/to/src] xml [path/to/phpmd.xml]`. The `phpmd-extension.phar` pass all arguments to the basic phpmd command. You don't have to install phpmd. `phpmd-extension.phar` includes phpmd.

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
        <exclude name="CyclomaticComplexity" />
    </rule>
    <rule ref="rulesets/codesize.xml/ExcessiveParameterList">
        <properties>
            <property name="minimum" value="4" />
        </properties>
    </rule>
    <rule ref="rulesets/codesize.xml/ExcessiveMethodLength">
        <properties>
            <property name="minimum" value="31" />
            <property name="ignore-whitespace" value="true" />
        </properties>
    </rule>
    <rule ref="rulesets/codesize.xml/ExcessiveClassLength">
        <properties>
            <property name="minimum" value="301" />
            <property name="ignore-whitespace" value="true" />
        </properties>
    </rule>
    <rule ref="rulesets/codesize.xml/CyclomaticComplexity">
        <properties>
            <property name="reportLevel" value="6" />
            <property name="showClassesComplexity" value="true" />
            <property name="showMethodsComplexity" value="true" />
        </properties>
    </rule>
    <rule ref="rulesets/controversial.xml" />
    <rule ref="rulesets/design.xml" />
    <rule ref="rulesets/naming.xml">
        <exclude name="ShortVariable" />
        <exclude name="LongVariable" />
    </rule>
    <rule ref="rulesets/naming.xml/ShortVariable">
        <properties>
            <property name="minimum" value="2" />
        </properties>
    </rule>
    <rule ref="rulesets/naming.xml/LongVariable">
        <properties>
            <property name="maximum" value="30" />
        </properties>
    </rule>
    <rule ref="rulesets/unusedcode.xml" />
</ruleset>
```

### Add extra rules

```xml
    <rule ref="../../../../../../rulesets/cleancode.xml" />
    <rule ref="../../../../../../rulesets/design.xml" />
    <rule ref="../../../../../../rulesets/naming.xml" />
    <rule ref="../../../../../../rulesets/test.xml" />
```

You can also customize the rules with own properties or use only specific rules. Just take a look in the xml files. It works as the basic ruleset logic.

## ToDos

- [ ] Rule against Train Wreck (getFoo()->getBar()->getMuh()->getMeh())
- [ ] Rule for high cohesion (member variables are used by a lot of methods)
- [ ] Rule that a service should never call a controller
