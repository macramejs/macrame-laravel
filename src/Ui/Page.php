<?php

namespace Macrame\Ui;

use Illuminate\Contracts\Support\Responsable;
use Inertia\Inertia;
use Inertia\Response;
use Macrame\Contracts\Form\Form;
use Macrame\Contracts\Table\Table;
use Macrame\Contracts\Ui\Page as PageContract;

class Page implements PageContract, Responsable
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
     * @param  Response $response
     * @param  Response $inertia
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
     * Add data to the page.
     *
     * @param  string $attribute
     * @param  string $data
     * @return $this
     */
    public function with($attribute, $data = null)
    {
        $this->data[$attribute] = $data;

        return $this;
    }

    /**
     * Add component to the page.
     *
     * @param  \Macrame\Contracts\Ui\Component|string $component
     * @return $this
     */
    public function component($component)
    {
        $this->components[] = component($component);

        return $this;
    }

    /**
     * Add a form to the page.
     *
     * @param  Form   $form
     * @param  string $route
     * @param  bool   $create
     * @return $this
     */
    public function form(Form $form, $route, $create = false)
    {
        $this->components[] = $form->render($route, $create);

        return $this;
    }

    /**
     * Add table to page.
     *
     * @param  Table  $table
     * @param  string $route
     * @return $this
     */
    public function table(Table $table, $route)
    {
        $this->components[] = $table->render($route);

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
     * @param  \Illuminate\Http\Request                   $request
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
