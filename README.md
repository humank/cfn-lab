# Purpose
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
2. Create an IAM Role for EC2 instance usage, which should be associated with EC2 SSM Parameter Store policies at least.
3. A good text editor tool, such as VS core, Sublime text, Atom, ... etc.
4. PHP or other language programming skiils, should not to be expert. Just need to modify arguments as you need.

# Go Labs

## Step 0 Prepare development environment

Recommend to use VS Core or Atom IDE to design CFN, leverage useful plugin would help you to design it effectively.

### VSCore

    [Official Web Site](https://code.visualstudio.com/)


### Atom

## Step 1 Create VPC template

## Step 2 Create Security Groups template

## Step 3 Create Application Load Balancer template

## Step 4 Create EC2 On-demand/Spot instances within AutoScaling group template

## Step 5 Create RDS-MySql template

The training material is reference from awslab [startup-kit-templates](https://github.com/awslabs/startup-kit-templates) and [ecs-refarch-cloudformation](https://github.com/awslabs/ecs-refarch-cloudformation).


# References

# Useful Cloudformation Template tools recommendation







