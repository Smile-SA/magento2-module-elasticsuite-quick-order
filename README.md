## README

### What does the module do ?

You should use this module in order to get ElasticSuite and Magento 2 B2B (Enterprise Edition only) features working together transparently.

It fixes issues that can be encountered when using the Quick Order feature.

### Which version should I use ?

**The module version patterns are identical to those of Elasticsuite.**

| Magento Version                              | Magento B2B Version | ElasticSuite Version    | Module version | Module composer install                                              | Elasticsearch (*) | OpenSearch (**) | Actively maintained |
|----------------------------------------------|---------------------|-------------------------|----------------|----------------------------------------------------------------------|-------------------|-----------------|---------------------|
| Magento **2.2.x** Commerce (EE)              | **1.0.x**           | ElasticSuite **2.6.x**  | **2.6.x**      | ```composer require smile/module-elasticsuite-quick-order ~2.6.0```  | 5.x & 6.x         | -               | No                  |
| Magento **<2.3.5** Commerce (EE)             | **1.1.x**           | ElasticSuite **2.8.x**  | **2.8.x**      | ```composer require smile/module-elasticsuite-quick-order ~2.8.0```  | 5.x & 6.x         | -               | No                  |
| Magento **>=2.3.5** Commerce (EE)            | **1.1.x**           | ElasticSuite **2.9.x**  | **2.9.x**      | ```composer require smile/module-elasticsuite-quick-order ~2.9.0```  | 6.x & 7.x         | -               | No                  |
| Magento **>=2.4.1 && < 2.4.6** Commerce (EE) | **1.3.x**           | ElasticSuite **2.10.x** | **2.10.x**     | ```composer require smile/module-elasticsuite-quick-order ~2.10.0``` | 6.x & 7.x         | 1.x & 2.x       | **Yes**             |
| Magento **>=2.4.6 && < 2.4.9** Commerce (EE) | **1.5.x**           | ElasticSuite **2.11.x** | **2.11.x**     | ```composer require smile/module-elasticsuite-quick-order ~2.11.0``` | 7.x & 8.x         | 1.x & 2.x       | **Yes**             |
| Magento **>=2.4.9** Commerce (EE)            | **1.5.x**           | ElasticSuite **2.12.x** | **2.12.x**     | ```composer require smile/module-elasticsuite-quick-order ~2.12.0``` | 7.x & 8.x         | 1.x & 2.x & 3.x | **Yes**             |

(*) and (**) Elasticseach and OpenSearch compatibility shown here is simplified, please refer to [Elasticsuite's README](https://github.com/Smile-SA/elasticsuite) for precise information.

### How to install ?

Simply run these commands in your Magento install :

```
composer require smile/module-elasticsuite-quick-order ~2.10.0
bin/magento setup:upgrade
```

Do not forget to clean caches and reindex everything !!!!

```
bin/magento cache:clean
bin/magento indexer:reindex
```

### What is ElasticSuite ?

Readme for the whole Smile ElasticSuite is available [here](https://github.com/Smile-SA/elasticsuite).

