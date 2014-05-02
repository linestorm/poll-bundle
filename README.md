Poll Component for LineStorm Post
=================================

Poll Component for the Post Module for the LineStorm BlogBundle.

Installation
============
This module will provide functionality to post blog type content to the LineStorm CMS.

1. Download bundle using composer
2. Enable the Bundle
3. Configure the Bundle
4. Installing Assets
5. Configuring Assets

Step 1: Download bundle using composer
--------------------------------------

Add `linestorm/poll-bundle` to your `composer.json` file, or download it by running the command:

```bash
$ php composer.phar require linestorm/poll-component-bundle
```

Step 2: Enable the bundle
-------------------------

Enable the poll bundle to your `app/AppKernel.php`:

```php
public function registerBundles()
{
    $bundles = array(
        // ...
        new LineStorm\PollComponentBundle\LineStormPollComponentBundle(),
    );
}
```

Step 3: Configure the Bundle
----------------------------

Add the class entity definitions in the line_storm_cms namespace and the media namespace
inside the `app/config/config.yml` file:

```yml
line_storm_cms:
  ...
  entity_classes:
    ...

    # Poll Component
    poll:                 Acme\DemoBundle\Entity\BlogPoll
    poll_option:          Acme\DemoBundle\Entity\BlogPollOption
    poll_answer:          Acme\DemoBundle\Entity\BlogPollAnswer
```

Step 4: Installing Assets
-------------------------

###Bower
Add [.bower.json](.bower.json) to the dependencies

###Manual
Download the modules in [.bower.json](.bower.json) to your assets folder


Step 5: Configuring Assets
-------------------------

You will need to add these dependency paths to your requirejs config:

```js
requirejs.config({
    paths: {
        // ...

        // cms poll library
        cms_poll:           '/path/to/bundles/linestormpollcomponent/js/poll',
        cms_poll_view:      '/path/to/bundles/linestormpollcomponent/js/poll_view',
    }
});
```


Documentation
=============

See [index.md](docs/index.md)
