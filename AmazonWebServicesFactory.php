<?php

namespace Cybernox\AmazonWebServicesBundle;

class AmazonWebServicesFactory
{
    private $validServiceTypes = array(
        'AS',
        'CloudFormation',
        'CloudFront',
        'CloudWatch',
        'EC2',
        'ELB',
        'EMR',
        'ElastiCache',
        'ElasticBeanstalk',
        'IAM',
        'ImportExport',
        'RDS',
        'S3',
        'SDB',
        'SES',
        'SNS',
        'SQS',
        'STS',
    );

    public function get(AmazonWebServices $aws, $serviceType)
    {
        if (! $this->isValidServiceType($serviceType))
        {
            throw new \RuntimeException(sprintf('Invalid Amazon Web Service Type requested [%s]', $serviceType));
        }

        $serviceObject = 'Amazon' . $serviceType;
        return new $serviceObject($aws->getKey(), $aws->getSecretKey());
    }

    private function isValidServiceType($type)
    {
        return (in_array($type, $this->validServiceTypes) ? true : false);
    }
}
