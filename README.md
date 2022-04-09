# Power BI Embedded

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)
[![Latest Version](https://img.shields.io/github/release/victorap93/powerbiembedded.svg?style=flat-square)](https://github.com/victorap93/powerbiembedded/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/victorap93/powerbiembedded.svg?style=flat-square)](https://packagist.org/packages/victorap93/powerbiembedded)

Power BI Embedded is an easy way to obtain the necessary token to build the Power BI Embedded interface


## Installation

The recommended way to install this is through
[Composer](https://getcomposer.org/).

```bash
composer require victorap93/powerbiembedded
```

## How to use

### Get the nedded parameters:

Read this [step](https://docs.microsoft.com/en-us/power-bi/developer/embedded/embed-sample-for-customers?tabs=net-core#step-5---get-the-embedding-parameter-values) to know how to get neded params.


### Get Embedded Token by using MS Client Secret:

```php
use \victorap93\PowerBIEmbedded\MSToken;
use \victorap93\PowerBIEmbedded\EmbeddedToken;

$tenantId = "";
$clientId = "";
$clientSecret = "";
$workspaceId = "";
$reportId = "";

$MSToken = new MSToken;
$ms_token = $MSToken->getMSTokenBySecret($tenantId, $clientId, $clientSecret);

$EmbeddedToken = new EmbeddedToken;
$result = $EmbeddedToken->getEmbeddedToken($workspaceId, $reportId, $embedded_token->access_token, ["accessLevel" => "View"]);

echo $embedded_token->token;
```


### Get Embedded Token by using MS Username and Password:

```php
use \victorap93\PowerBIEmbedded\MSToken;
use \victorap93\PowerBIEmbedded\EmbeddedToken;

$tenantId = "";
$clientId = "";
$username = "";
$password = "";
$workspaceId = "";
$reportId = "";

$MSToken = new MSToken;
$ms_token = $MSToken->getMSTokenByCredentials($tenant_id, $client_id, $username, $password);

$EmbeddedToken = new EmbeddedToken;
$result = $EmbeddedToken->getEmbeddedToken($workspaceId, $reportId, $embedded_token->access_token, ["accessLevel" => "View"]);

echo $embedded_token->token;
```


## Help and docs

- [Power BI developer documentation](https://docs.microsoft.com/en-us/power-bi/developer/)
- [Tutorial: Embed Power BI content using a sample embed for your customers application](https://docs.microsoft.com/en-us/power-bi/developer/embedded/embed-sample-for-customers?tabs=net-core)
- [Power BI Developer Samples](https://github.com/Microsoft/PowerBI-Developer-Samples)
- [Power BI Sandbox](https://playground.powerbi.com/pt-br/dev-sandbox)
- [Request Body](https://docs.microsoft.com/en-us/rest/api/power-bi/embed-token/datasets-generate-token-in-group#request-body)


## More
You can see full implementation with these two projects: 
* [PHP API](https://github.com/victorap93/powerbiembedded-php-api)
* [React APP](https://github.com/victorap93/powerbiembedded-react-app)


## License

Power BI Embedded is made available under the MIT License (MIT). Please see [License File](LICENSE) for more information.
