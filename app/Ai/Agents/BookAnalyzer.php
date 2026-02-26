<?php

namespace App\Ai\Agents;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Promptable;
use Stringable;

class BookAnalyzer implements Agent, Conversational, HasTools, HasStructuredOutput
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return 'You are an expert in the art of extracting metadata from pdf books';
    }

    /**
     * Get the list of messages comprising the conversation so far.
     */
    public function messages(): iterable
    {
        return [];
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [];
    }

    /**
     * Get the agent's structured output schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'title' => $schema->string()->max(20)->required(),
            'authors' => $schema->array()
                ->items(
                    $schema->object([
                        'first_name' => $schema->string()->max(10)->required(),
                        'last_name' => $schema->string()->max(10)->required(),
                    ])
                )
                ->required(),
            'publisher' => $schema->string()->required(),
            'isbn' => $schema->string(),
            'pages' => $schema->integer()->required(),
            'release_date' => $schema->string()->required(),
            'language' => $schema->string()->required(),
            'categories' => $schema->array()
                ->items($schema->string()->max(20))
                ->required(),
            'synopsis' => $schema->string()->required(),
            'edition' => $schema->string()->required(),
        ];
    }
}
