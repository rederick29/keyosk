<?php

namespace App\View\Components\Testimonials;

use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TestimonialCard extends Component
{
    public int $rating;
    public string $subject;
    public string $comment;
    public string $name;

    /**
     * Create a new component instance.
     * @throws Exception
     */
    public function __construct(int $rating, string $subject, string $comment, string $name)
    {
        $this->rating = $rating;
        if($this->rating < 0 || $this->rating > 10)
        {
            throw new Exception('Rating is out of range');
        }

        $this->subject = $subject;
        if(empty($this->subject))
        {
            throw new Exception('Subject cannot be empty');
        }

        $this->comment = $comment;
        if(empty($this->comment))
        {
            throw new Exception('Comment cannot be empty');
        }

        $this->name = $name;
        if(empty($this->name))
        {
            throw new Exception('Name cannot be empty');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components..testimonials.testimonial-card');
    }
}
