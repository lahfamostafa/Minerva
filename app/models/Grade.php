<?php

    class grade{
    private ?int $id;
    private int $submissionId;
    private float $grade;
    private string $comments;

    public function __construct(?int $id, int $submissionId, float $grade, string $comments)
    {
        $this->id = $id;
        $this->submissionId = $submissionId;
        $this->grade = $grade;
        $this->comments = $comments;  

    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getSubmissionId(): int
    {
        return $this->submissionId;
    }

    public function getGrade(): float
    {
        return $this->grade;
    }
    public function getComments(): string
    {
        return $this->comments;
    }
    }