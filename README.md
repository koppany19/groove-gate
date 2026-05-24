# 🎵 GrooveGate

> Music booking and ticketing platform built with 
> Laravel 11 — connecting organisers, artists and audiences.

[![Laravel](https://img.shields.io/badge/Laravel-11-red)]()
[![PHP](https://img.shields.io/badge/PHP-8.4-blue)]()
[![License](https://img.shields.io/badge/license-MIT-green)]()

## Live Demo
🌐 http://157.230.112.32

## Overview
GrooveGate is a full-stack music event management 
platform with three user roles: organisers, artists 
and audiences. Built as a university thesis project 
over one semester using agile methodology (5 sprints).

## Key Features
- 🎛️ **MixerAI** — Claude API Tool Use based AI agent
  for event planning, artist booking and career advice
- 💳 **Stripe Checkout** — secure ticket purchasing
  with webhook-based ticket generation
- 🎟️ **QR Code tickets** — unique barcodes with 
  organiser validation
- 📊 **Dynamic pricing** — time and occupancy based
  algorithm similar to airline pricing
- 💺 **Visual seat map** — interactive seat selection
  with Alpine.js
- 💬 **Chat system** — booking-based messaging between
  organisers and artists with Livewire polling
- 🔔 **Notifications** — Laravel database notifications
  for booking and ticket events

## Tech Stack

| Category | Technology |
|----------|-----------|
| Backend | Laravel 11, PHP 8.4 |
| Frontend | TailwindCSS v4, Alpine.js, Livewire 3 |
| Database | MySQL 8.0 |
| Payment | Stripe Checkout |
| AI | Anthropic Claude API (Tool Use) |
| Server | DigitalOcean VPS, Ubuntu 24, Nginx |
| Dev | Laravel Sail (Docker), GitLab CI |

## Architecture Highlights
- Role-based access control (organiser/artist/audience)
- Feature branch git workflow
- AI Agent with Tool Use, memory and compaction
- Stripe webhook idempotency
- Laravel notifications system
