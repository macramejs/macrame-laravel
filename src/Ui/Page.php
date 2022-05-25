<?php

namespace Macrame\Ui;

use Inertia\Inertia;
use Inertia\Response;
use Macrame\Contracts\Ui\Page as PageContract;

class Page implements PageContract
{
    /**
     * Page data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Page components.
     *
     * @var array
     */
    protected $components = [];

    /**
     * The inertia component name.
     *
     * @var string
     */
    protected $inertiaComponent = 'BasePage';

    /**
     * View name.
     *
     * @var string
     */
    protected $view = 'app';

    /**
     * Mount the page.
     *
     * @param  Response  $response
     * @param  Response  $inertia
     * @return void
     */
    public function mount(Response $inertia)
    {
        //
    }

    /**
     * Get the inertia page name.
     *
     * @return string
     */
    public function getInertiaComponent()
    {
        return $this->inertiaComponent;
    }

    /**
     * Set the inertia component.
     *
     * @param  string  $page
     * @return $this
     */
    public function page($page)
    {
        $this->inertiaComponent = $page;

        return $this;
    }

    /**
     * Add data to the page.
     *
     * @param  string|array  $key
     * @param  string  $value
     * @return $this
     */
    public function with($key, $value = null)
    {
        if (is_array($key)) {
            $this->data = array_merge($this->data, $key);
        } else {
            $this->data[$key] = $value;
        }

        return $this;
    }

    /**
     * Add component to the page.
     *
     * @param  \Macrame\Contracts\Ui\Component|string  $component
     * @return $this
     */
    public function component($component)
    {
        $this->components[] = component($component);

        return $this;
    }

    /**
     * Get view name.
     *
     * @return string
     */
    public function getViewName()
    {
        return $this->view;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return $this->render()->toResponse($request);
    }

    /**
     * Render the page.
     *
     * @return \Inertia\Response
     */
    public function render()
    {
        Inertia::setRootView($this->getViewName());

        $response = Inertia::render($this->getInertiaComponent(), array_merge(
            $this->data,
            ['components' => $this->components]
        ));

        $this->mount($response);

        return $response;
    }
}
