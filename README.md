# phpmd-extension

[![GitHub license](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://raw.githubusercontent.com/mi-schi/phpmd-extension/master/LICENSE)
[![Build Status](https://scrutinizer-ci.com/g/mi-schi/phpmd-extension/badges/build.png?b=master)](https://scrutinizer-ci.com/g/mi-schi/phpmd-extension/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/mi-schi/phpmd-extension/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mi-schi/phpmd-extension/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mi-schi/phpmd-extension/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mi-schi/phpmd-extension/?branch=master)
[![Github All Releases](https://img.shields.io/github/downloads/mi-schi/phpmd-extension/total.svg?maxAge=2592000)](https://github.com/mi-schi/phpmd-extension)

## Features

Contains extra phpmd rules from clean code book and the best practices of my experiences.

* CleanCode
    * [ConditionalExpression](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/cleancode.xml#L14-L15) - increase readability
    * [ConstructorNewOperator](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/cleancode.xml#L37-L40) - decouple classes, see open-close principle
    * [DataStructureConstants](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/cleancode.xml#L78-L80) - increase maintainability
    * [DataStructureMethods](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/cleancode.xml#L114-L116) - increase extensibility, see single-responsibility principle
    * [MemberPrimaryPrefix](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/cleancode.xml#L167-L168) - supports low coupling, increase testability, see law of demeter
    * [PublicFieldDeclaration](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/cleancode.xml#L217-L218) - increase maintainability, see encapsulation/information hiding
    * [ReturnStatement](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/cleancode.xml#L244-L245) - increase reading rate, increase extensibility
    * [SwitchStatement](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/cleancode.xml#L291-L295) - increase extensibility, see open-close principle
    * [TraitPublicMethod](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/cleancode.xml#L347-L350) - increase maintainability, see encapsulation/information hiding
    * [TryStatement](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/cleancode.xml#L383) - increase readability
* Naming
    * [ClassNameSuffix](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/naming.xml#L15-L18) - increase extensibility, see single-responsibility principle
    * [CommentDescription](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/naming.xml#L47-L50) - reduce unused declarations, increase comprehensibility
    * [ControllerMethodName](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/naming.xml#L107-L109) - increase reusability, see single-responsibility principle
    * [MethodName](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/naming.xml#L138-L140) - increase readability, increase comprehensibility
* Test
    * [NumberOfMocks](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/test.xml#L14-L17) - increase testability, supports low coupling, see single-responsibility principle
    * [NumberOfAsserts](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/test.xml#L56-L58) - increase maintainability, speed up debugging, see single-responsibility principle
    * [MethodName](https://github.com/mi-schi/phpmd-extension/blob/master/rulesets/test.xml#L98-L99) - increase readability, increase comprehensibility
    
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
    <rule ref="../../../../../../rulesets/naming.xml" />
    <rule ref="../../../../../../rulesets/test.xml" />
```

You can also customize the rules with own properties or use only specific rules. Just take a look in the xml files. It works as the basic ruleset logic.

## ToDos

- [ ] Rule for high cohesion (member variables are used by a lot of methods)
- [ ] Rule that a service should never call a controller
