# Purpose

![System Architecture](images/system-architecture-v2.png "System Architecture")

To familiar with Infrastructure as code, using AWS Cloudformation template to design a sample web application architecture.

Go through this lab, you will realize Cloudformation (a.k.a -> cfn) how to arrange resources, coordinate the resources component interaction, and associate them within few commands.

The Simple Web Application designed with: 

* VPC
* Security Group
* Application Load Balancer
* RDS-Mysql
* EC2 On-demand/Spot instances
* Simple System Manager - Parameter Store

# Key Concepts

Cloudfomration components design just like playing lego. If you want to construct a robustness basis architecture, then you do need to consider about draft it as blueprint. Incrementally add on and iteratively deploy, validate it.

# Pre-requistie

1. Take or Create an IAM User for Cloudformation instruction, ensure the IAM user was associated with enough policies to do.
2. Download or create Keypair named : **labuserkey** for the default cloudformation template resource instruction usage.
3. Create an IAM Role for EC2 instance usage, which should be associated with EC2 SSM Parameter Store policies at least.
4. A good text editor tool, such as VS core, Sublime text, Atom, ... etc.
5. PHP or other language programming skiils, should not to be expert. Just need to modify arguments as you need.

# Go Labs

## Prepare development environment

Recommend to use Visual Studio Code or Atom IDE to design CFN, leverage useful plugin would help you to design it effectively.

### To adopt JSON or YAML in Cloudformation ?

Generally speaking, depends on your team. There are some criterias to help you make decision.

* Do you need comments in template ?
* Do you need to train or facilitate guys to get familiar with cfn?

In case of which 1 you need, recommend to use YAML.

Of course, you can also transfer the different format in 1 second, check this -> 
[Tool for converting AWS CloudFormation templates between JSON and YAML formats](https://github.com/awslabs/aws-cfn-template-flip)

### Visual Studio Code

[Visual Studio Code official Web Site ](https://code.visualstudio.com/)

[VS Code plugin for Cloudformation - JSON](https://marketplace.visualstudio.com/items?itemName=aws-scripting-guy.cform)

![VS Code plugin for Cloudformation](images/vscode-cfn-json.gif "Visual Studio Code Cloudformation plugin")

[VS Code plugin for Cloudfromation - YAML](https://marketplace.visualstudio.com/items?itemName=DanielThielking.aws-cloudformation-yaml)

### Atom

[Atom Official Web Site](https://atom.io/)

[Atom atom-cform-yaml package](https://atom.io/packages/atom-cform-yaml)

![ATOM plugin for Cloudformation YAML](images/atom-cfn-yaml.gif "ATOM plugin for Cloudformation YAML")

[Atom atom-cform package](https://atom.io/packages/atom-cform)

![ATOM plugin for Cloudformation JSON](images/atom-cfn-json.gif "ATOM plugin for Cloudformation JSON")

## OneClick Go

In order to quickly lanuch CLoudformation Stack, choose 1 of 5 regions which listed here as the below. if you prefer to create stack at other regions, then you just need to click the region selection at aws management console top right cornor.

click the button to launch the demo stack in *Tokyo*

[![cloudformation-launch-stack](https://s3.amazonaws.com/cloudformation-examples/cloudformation-launch-stack.png)](https://console.aws.amazon.com/cloudformation/home?region=ap-northeast-1#/stacks/new?stackName=nov-15-go&templateURL=https://s3.us-east-2.amazonaws.com/cnf-stackset-lab-20171116-dlink/master.yml)

***

click the button to launch the demo stack in *us-east-1*

[![cloudformation-launch-stack](https://s3.amazonaws.com/cloudformation-examples/cloudformation-launch-stack.png)](https://console.aws.amazon.com/cloudformation/home?region=us-east-1#/stacks/new?stackName=nov-15-go&templateURL=https://s3.us-east-2.amazonaws.com/cnf-stackset-lab-20171116-dlink/master.yml)

***

click the button to launch the demo stack in *us-east-2*

[![cloudformation-launch-stack](https://s3.amazonaws.com/cloudformation-examples/cloudformation-launch-stack.png)](https://console.aws.amazon.com/cloudformation/home?region=us-east-2#/stacks/new?stackName=nov-15-go&templateURL=https://s3.us-east-2.amazonaws.com/cnf-stackset-lab-20171116-dlink/master.yml)

***

click the button to launch the demo stack in *us-west-1*

[![cloudformation-launch-stack](https://s3.amazonaws.com/cloudformation-examples/cloudformation-launch-stack.png)](https://console.aws.amazon.com/cloudformation/home?region=us-west-1#/stacks/new?stackName=nov-15-go&templateURL=https://s3.us-east-2.amazonaws.com/cnf-stackset-lab-20171116-dlink/master.yml)

***

click the button to launch the demo stack in *us-west-2*

[![cloudformation-launch-stack](https://s3.amazonaws.com/cloudformation-examples/cloudformation-launch-stack.png)](https://console.aws.amazon.com/cloudformation/home?region=us-west-2#/stacks/new?stackName=nov-15-go&templateURL=https://s3.us-east-2.amazonaws.com/cnf-stackset-lab-20171116-dlink/master.yml)

***

### About StackName

StackName validate name length is 32 chars, by using nested Stackset, recommend to have good naming convention to prevent hit the max-length limit.

Try to use the naming convention : 

>{YourName}-{Number}

ex:

>Kim-1



Whole Stack creation would take 20 minutes or more, depends on regional resources arrangement status.

>After creation completed, check the cloudformation Output and click the ***LoadBalancerURL*** link at master stack Output or loadbalancer stack Outputs to see the result.

![Application LoadBalancer URL](images/cfn-creation-completed.png "System Architecture")

***

If you visit the LoadBalancer URL and get 503 Service Temporarily Unavailable !!! 

![HTTP 503 error](images/alb-check-fail.png "503 Service Temporarily Unavailable")

or you face the AMI Test Page

![AMI Test Page](images/ami-test.png "AMI Test Page")


It's because the created EC2 instances are still running userdata initializing process, and Application Load Balancer Health Check has started to check staus. While initialized then it would be okay.

***

The result - Application Load Balancer disptach ingress traffics by round-robin, you would see different instances to serve the traffic.

**Public Subnet 1 - 10.180.8.***

![Public Subnet 1 - 10.180.8.X](images/round-robin-access-1.png "10.180.8.x")

**Public Subnet 2 - 10.180.16.***

![Public Subnet 2 - 10.180.16.X](images/round-robin-access-2.png "10.180.16.x")

***

## Hands-on practice

1. Clone lab project

> git clone https://github.com/humank/20171116-cfn-lab.git

2. Create S3 Bucket to store Cloudformation Template for later usage.

> Recommend to practice this lab at nearest Region to get better user experience.

3. Generate or keep the IAM User Accesskey csv file, will leverage the Accesskey and AccessSecurityKey to SSH into EC2 instance for check status. 

4. Modify the file : 20171116-cfn-lab/infrastructure/master.yml, replace all the contained stack yml file path to your s3 bucket which just created.

5. Modify the file : 20171116-cfn-lab/web/index.php, replace the line

> curl -o index.php https://s3.us-east-2.amazonaws.com/cnf-stackset-lab-20171116-dlink/index.php >> /tmp/userdata.log 2>&1 

> change it to crul to your s3 bucket path.

**Don't forget make your index.php file public.**




